<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    1.8.0, 2014-03-02
 */


/** PHPExcel root directory */
if (!defined('PHPEXCEL_ROOT')) {
    define('PHPEXCEL_ROOT', dirname(__FILE__) . '/');
    require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}


/**
 * PHPExcel
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel
{
    /**
     * Unique ID
     *
     * @var string
     */
    private $_uniqueID;

    /**
     * Document properties
     *
     * @var PHPExcel_DocumentProperties
     */
    private $_properties;

    /**
     * Document security
     *
     * @var PHPExcel_DocumentSecurity
     */
    private $_security;

    /**
     * Collection of Worksheet objects
     *
     * @var PHPExcel_Worksheet[]
     */
    private $_workSheetCollection = array();

    /**
     * Calculation Engine
     *
     * @var PHPExcel_Calculation
     */
    private $_calculationEngine = NULL;

    /**
     * Active sheet index
     *
     * @var int
     */
    private $_activeSheetIndex = 0;

    /**
     * Named ranges
     *
     * @var PHPExcel_NamedRange[]
     */
    private $_namedRanges = array();

    /**
     * CellXf supervisor
     *
     * @var PHPExcel_Style
     */
    private $_cellXfSupervisor;

    /**
     * CellXf collection
     *
     * @var PHPExcel_Style[]
     */
    private $_cellXfCollection = array();

    /**
     * CellStyleXf collection
     *
     * @var PHPExcel_Style[]
     */
    private $_cellStyleXfCollection = array();

    /**
     * _hasMacros : this workbook have macros ?
     *
     * @var bool
     */
    private $_hasMacros = FALSE;

    /**
     * _macrosCode : all macros code (the vbaProject.bin file, this include form, code,  etc.), NULL if no macro
     *
     * @var binary
     */
    private $_macrosCode = NULL;
    /**
     * _macrosCertificate : if macros are signed, contains vbaProjectSignature.bin file, NULL if not signed
     *
     * @var binary
     */
    private $_macrosCertificate = NULL;

    /**
     * _ribbonXMLData : NULL if workbook is'nt Excel 2007 or not contain a customized UI
     *
     * @var NULL|string
     */
    private $_ribbonXMLData = NULL;

    /**
     * _ribbonBinObjects : NULL if workbook is'nt Excel 2007 or not contain embedded objects (picture(s)) for Ribbon Elements
     * ignored if $_ribbonXMLData is null
     *
     * @var NULL|array
     */
    private $_ribbonBinObjects = NULL;

    /**
     * The workbook has macros ?
     *
     * @return true if workbook has macros, false if not
     */
    public function hasMacros()
    {
        return $this->_hasMacros;
    }

    /**
     * Define if a workbook has macros
     *
     * @param true|false
     */
    public function setHasMacros($hasMacros = false)
    {
        $this->_hasMacros = (bool)$hasMacros;
    }

    /**
     * Set the macros code
     *
     * @param binary string|null
     */
    public function setMacrosCode($MacrosCode)
    {
        $this->_macrosCode = $MacrosCode;
        $this->setHasMacros(!is_null($MacrosCode));
    }

    /**
     * Return the macros code
     *
     * @return binary|null
     */
    public function getMacrosCode()
    {
        return $this->_macrosCode;
    }

    /**
     * Set the macros certificate
     *
     * @param binary|null
     */
    public function setMacrosCertificate($Certificate = NULL)
    {
        $this->_macrosCertificate = $Certificate;
    }

    /**
     * Is the project signed ?
     *
     * @return true|false
     */
    public function hasMacrosCertificate()
    {
        return !is_null($this->_macrosCertificate);
    }

    /**
     * Return the macros certificate
     *
     * @return binary|null
     */
    public function getMacrosCertificate()
    {
        return $this->_macrosCertificate;
    }

    /**
     * Remove all macros, certificate from spreadsheet
     *
     * @param none
     * @return void
     */
    public function discardMacros()
    {
        $this->_hasMacros = false;
        $this->_macrosCode = NULL;
        $this->_macrosCertificate = NULL;
    }

    /**
     * set ribbon XML data
     *
     */
    public function setRibbonXMLData($Target = NULL, $XMLData = NULL)
    {
        if (!is_null($Target) && !is_null($XMLData)) {
            $this->_ribbonXMLData = array('target' => $Target, 'data' => $XMLData);
        } else {
            $this->_ribbonXMLData = NULL;
        }
    }

    /**
     * retrieve ribbon XML Data
     *
     * return string|null|array
     */
    public function getRibbonXMLData($What = 'all')
    {//we need some constants here...
        $ReturnData = NULL;
        $What = strtolower($What);
        switch ($What) {
            case 'all':
                $ReturnData = $this->_ribbonXMLData;
                break;
            case 'target':
            case 'data':
                if (is_array($this->_ribbonXMLData) && array_key_exists($What, $this->_ribbonXMLData)) {
                    $ReturnData = $this->_ribbonXMLData[$What];
                }//else $ReturnData stay at null
                break;
        }//default: $ReturnData at null
        return $ReturnData;
    }

    /**
     * store binaries ribbon objects (pictures)
     *
     */
    public function setRibbonBinObjects($BinObjectsNames = NULL, $BinObjectsData = NULL)
    {
        if (!is_null($BinObjectsNames) && !is_null($BinObjectsData)) {
            $this->_ribbonBinObjects = array('names' => $BinObjectsNames, 'data' => $BinObjectsData);
        } else {
            $this->_ribbonBinObjects = NULL;
        }
    }

    /**
     * return the extension of a filename. Internal use for a array_map callback (php<5.3 don't like lambda function)
     *
     */
    private function _getExtensionOnly($ThePath)
    {
        return pathinfo($ThePath, PATHINFO_EXTENSION);
    }

    /**
     * retrieve Binaries Ribbon Objects
     *
     */
    public function getRibbonBinObjects($What = 'all')
    {
        $ReturnData = NULL;
        $What = strtolower($What);
        switch ($What) {
            case 'all':
                return $this->_ribbonBinObjects;
                break;
            case 'names':
            case 'data':
                if (is_array($this->_ribbonBinObjects) && array_key_exists($What, $this->_ribbonBinObjects)) {
                    $ReturnData = $this->_ribbonBinObjects[$What];
                }
                break;
            case 'types':
                if (is_array($this->_ribbonBinObjects) && array_key_exists('data', $this->_ribbonBinObjects) && is_array($this->_ribbonBinObjects['data'])) {
                    $tmpTypes = array_keys($this->_ribbonBinObjects['data']);
                    $ReturnData = array_unique(array_map(array($this, '_getExtensionOnly'), $tmpTypes));
                } else
                    $ReturnData = array();//the caller want an array... not null if empty
                break;
        }
        return $ReturnData;
    }

    /**
     * This workbook have a custom UI ?
     *
     * @return true|false
     */
    public function hasRibbon()
    {
        return !is_null($this->_ribbonXMLData);
    }

    /**
     * This workbook have additionnal object for the ribbon ?
     *
     * @return true|false
     */
    public function hasRibbonBinObjects()
    {
        return !is_null($this->_ribbonBinObjects);
    }

    /**
     * Check if a sheet with a specified code name already exists
     *
     * @param string $pSheetCodeName Name of the worksheet to check
     * @return boolean
     */
    public function sheetCodeNameExists($pSheetCodeName)
    {
        return ($this->getSheetByCodeName($pSheetCodeName) !== NULL);
    }

    /**
     * Get sheet by code name. Warning : sheet don't have always a code name !
     *
     * @param string $pName Sheet name
     * @return PHPExcel_Worksheet
     */
    public function getSheetByCodeName($pName = '')
    {
        $worksheetCount = count($this->_workSheetCollection);
        for ($i = 0; $i < $worksheetCount; ++$i) {
            if ($this->_workSheetCollection[$i]->getCodeName() == $pName) {
                return $this->_workSheetCollection[$i];
            }
        }

        return null;
    }

    /**
     * Create a new PHPExcel with one Worksheet
     */
    public function __construct()
    {
        $this->_uniqueID = uniqid();
        $this->_calculationEngine = PHPExcel_Calculation::getInstance($this);

        // Initialise worksheet collection and add one worksheet
        $this->_workSheetCollection = array();
        $this->_workSheetCollection[] = new PHPExcel_Worksheet($this);
        $this->_activeSheetIndex = 0;

        // Create document properties
        $this->_properties = new PHPExcel_DocumentProperties();

        // Create document security
        $this->_security = new PHPExcel_DocumentSecurity();

        // Set named ranges
        $this->_namedRanges = array();

        // Create the cellXf supervisor
        $this->_cellXfSupervisor = new PHPExcel_Style(true);
        $this->_cellXfSupervisor->bindParent($this);

        // Create the default style
        $this->addCellXf(new PHPExcel_Style);
        $this->addCellStyleXf(new PHPExcel_Style);
    }

    /**
     * Code to execute when this worksheet is unset()
     *
     */
    public function __destruct()
    {
        PHPExcel_Calculation::unsetInstance($this);
        $this->disconnectWorksheets();
    }    //    function __destruct()

    /**
     * Disconnect all worksheets from this PHPExcel workbook object,
     *    typically so that the PHPExcel object can be unset
     *
     */
    public function disconnectWorksheets()
    {
        $worksheet = NULL;
        foreach ($this->_workSheetCollection as $k => &$worksheet) {
            $worksheet->disconnectCells();
            $this->_workSheetCollection[$k] = null;
        }
        unset($worksheet);
        $this->_workSheetCollection = array();
    }

    /**
     * Return the calculation engine for this worksheet
     *
     * @return PHPExcel_Calculation
     */
    public function getCalculationEngine()
    {
        return $this->_calculationEngine;
    }    //	function getCellCacheController()

    /**
     * Get properties
     *
     * @return PHPExcel_DocumentProperties
     */
    public function getProperties()
    {
        return $this->_properties;
    }

    /**
     * Set properties
     *
     * @param PHPExcel_DocumentProperties $pValue
     */
    public function setProperties(PHPExcel_DocumentProperties $pValue)
    {
        $this->_properties = $pValue;
    }

    /**
     * Get security
     *
     * @return PHPExcel_DocumentSecurity
     */
    public function getSecurity()
    {
        return $this->_security;
    }

    /**
     * Set security
     *
     * @param PHPExcel_DocumentSecurity $pValue
     */
    public function setSecurity(PHPExcel_DocumentSecurity $pValue)
    {
        $this->_security = $pValue;
    }

    /**
     * Get active sheet
     *
     * @return PHPExcel_Worksheet
     */
    public function getActiveSheet()
    {
        return $this->_workSheetCollection[$this->_activeSheetIndex];
    }

    /**
     * Create sheet and add it to this workbook
     *
     * @param  int|null $iSheetIndex Index where sheet should go (0,1,..., or null for last)
     * @return PHPExcel_Worksheet
     * @throws PHPExcel_Exception
     */
    public function createSheet($iSheetIndex = NULL)
    {
        $newSheet = new PHPExcel_Worksheet($this);
        $this->addSheet($newSheet, $iSheetIndex);
        return $newSheet;
    }

    /**
     * Check if a sheet with a specified name already exists
     *
     * @param  string $pSheetName Name of the worksheet to check
     * @return boolean
     */
    public function sheetNameExists($pSheetName)
    {
        return ($this->getSheetByName($pSheetName) !== NULL);
    }

    /**
     * Add sheet
     *
     * @param  PHPExcel_Worksheet $pSheet
     * @param  int|null $iSheetIndex Index where sheet should go (0,1,..., or null for last)
     * @return PHPExcel_Worksheet
     * @throws PHPExcel_Exception
     */
    public function addSheet(PHPExcel_Worksheet $pSheet, $iSheetIndex = NULL)
    {
        if ($this->sheetNameExists($pSheet->getTitle())) {
            throw new PHPExcel_Exception(
                "Workbook already contains a worksheet named '{$pSheet->getTitle()}'. Rename this worksheet first."
            );
        }

        if ($iSheetIndex === NULL) {
            if ($this->_activeSheetIndex < 0) {
                $this->_activeSheetIndex = 0;
            }
            $this->_workSheetCollection[] = $pSheet;
        } else {
            // Insert the sheet at the requested index
            array_splice(
                $this->_workSheetCollection,
                $iSheetIndex,
                0,
                array($pSheet)
            );

            // Adjust active sheet index if necessary
            if ($this->_activeSheetIndex >= $iSheetIndex) {
                ++$this->_activeSheetIndex;
            }
        }

        if ($pSheet->getParent() === null) {
            $pSheet->rebindParent($this);
        }

        return $pSheet;
    }

    /**
     * Remove sheet by index
     *
     * @param  int $pIndex Active sheet index
     * @throws PHPExcel_Exception
     */
    public function removeSheetByIndex($pIndex = 0)
    {

        $numSheets = count($this->_workSheetCollection);

        if ($pIndex > $numSheets - 1) {
            throw new PHPExcel_Exception(
                "You tried to remove a sheet by the out of bounds index: {$pIndex}. The actual number of sheets is {$numSheets}."
            );
        } else {
            array_splice($this->_workSheetCollection, $pIndex, 1);
        }
        // Adjust active sheet index if necessary
        if (($this->_activeSheetIndex >= $pIndex) &&
            ($pIndex > count($this->_workSheetCollection) - 1)
        ) {
            --$this->_activeSheetIndex;
        }

    }

    /**
     * Get sheet by index
     *
     * @param  int $pIndex Sheet index
     * @return PHPExcel_Worksheet
     * @throws PHPExcel_Exception
     */
    public function getSheet($pIndex = 0)
    {

        $numSheets = count($this->_workSheetCollection);

        if ($pIndex > $numSheets - 1) {
            throw new PHPExcel_Exception(
                "Your requested sheet index: {$pIndex} is out of bounds. The actual number of sheets is {$numSheets}."
            );
        } else {
            return $this->_workSheetCollection[$pIndex];
        }
    }

    /**
     * Get all sheets
     *
     * @return PHPExcel_Worksheet[]
     */
    public function getAllSheets()
    {
        return $this->_workSheetCollection;
    }

    /**
     * Get sheet by name
     *
     * @param  string $pName Sheet name
     * @return PHPExcel_Worksheet
     */
    public function getSheetByName($pName = '')
    {
        $worksheetCount = count($this->_workSheetCollection);
        for ($i = 0; $i < $worksheetCount; ++$i) {
            if ($this->_workSheetCollection[$i]->getTitle() === $pName) {
                return $this->_workSheetCollection[$i];
            }
        }

        return NULL;
    }

    /**
     * Get index for sheet
     *
     * @param  PHPExcel_Worksheet $pSheet
     * @return Sheet index
     * @throws PHPExcel_Exception
     */
    public function getIndex(PHPExcel_Worksheet $pSheet)
    {
        foreach ($this->_workSheetCollection as $key => $value) {
            if ($value->getHashCode() == $pSheet->getHashCode()) {
                return $key;
            }
        }

        throw new PHPExcel_Exception("Sheet does not exist.");
    }

    /**
     * Set index for sheet by sheet name.
     *
     * @param  string $sheetName Sheet name to modify index for
     * @param  int $newIndex New index for the sheet
     * @return New sheet index
     * @throws PHPExcel_Exception
     */
    public function setIndexByName($sheetName, $newIndex)
    {
        $oldIndex = $this->getIndex($this->getSheetByName($sheetName));
        $pSheet = array_splice(
            $this->_workSheetCollection,
            $oldIndex,
            1
        );
        array_splice(
            $this->_workSheetCollection,
            $newIndex,
            0,
            $pSheet
        );
        return $newIndex;
    }

    /**
     * Get sheet count
     *
     * @return int
     */
    public function getSheetCount()
    {
        return count($this->_workSheetCollection);
    }

    /**
     * Get active sheet index
     *
     * @return int Active sheet index
     */
    public function getActiveSheetIndex()
    {
        return $this->_activeSheetIndex;
    }

    /**
     * Set active sheet index
     *
     * @param  int $pIndex Active sheet index
     * @throws PHPExcel_Exception
     * @return PHPExcel_Worksheet
     */
    public function setActiveSheetIndex($pIndex = 0)
    {
        $numSheets = count($this->_workSheetCollection);

        if ($pIndex > $numSheets - 1) {
            throw new PHPExcel_Exception(
                "You tried to set a sheet active by the out of bounds index: {$pIndex}. The actual number of sheets is {$numSheets}."
            );
        } else {
            $this->_activeSheetIndex = $pIndex;
        }
        return $this->getActiveSheet();
    }

    /**
     * Set active sheet index by name
     *
     * @param  string $pValue Sheet title
     * @return PHPExcel_Worksheet
     * @throws PHPExcel_Exception
     */
    public function setActiveSheetIndexByName($pValue = '')
    {
        if (($worksheet = $this->getSheetByName($pValue)) instanceof PHPExcel_Worksheet) {
            $this->setActiveSheetIndex($this->getIndex($worksheet));
            return $worksheet;
        }

        throw new PHPExcel_Exception('Workbook does not contain sheet:' . $pValue);
    }

    /**
     * Get sheet names
     *
     * @return string[]
     */
    public function getSheetNames()
    {
        $returnValue = array();
        $worksheetCount = $this->getSheetCount();
        for ($i = 0; $i < $worksheetCount; ++$i) {
            $returnValue[] = $this->getSheet($i)->getTitle();
        }

        return $returnValue;
    }

    /**
     * Add external sheet
     *
     * @param  PHPExcel_Worksheet $pSheet External sheet to add
     * @param  int|null $iSheetIndex Index where sheet should go (0,1,..., or null for last)
     * @throws PHPExcel_Exception
     * @return PHPExcel_Worksheet
     */
    public function addExternalSheet(PHPExcel_Worksheet $pSheet, $iSheetIndex = null)
    {
        if ($this->sheetNameExists($pSheet->getTitle())) {
            throw new PHPExcel_Exception("Workbook already contains a worksheet named '{$pSheet->getTitle()}'. Rename the external sheet first.");
        }

        // count how many cellXfs there are in this workbook currently, we will need this below
        $countCellXfs = count($this->_cellXfCollection);

        // copy all the shared cellXfs from the external workbook and append them to the current
        foreach ($pSheet->getParent()->getCellXfCollection() as $cellXf) {
            $this->addCellXf(clone $cellXf);
        }

        // move sheet to this workbook
        $pSheet->rebindParent($this);

        // update the cellXfs
        foreach ($pSheet->getCellCollection(false) as $cellID) {
            $cell = $pSheet->getCell($cellID);
            $cell->setXfIndex($cell->getXfIndex() + $countCellXfs);
        }

        return $this->addSheet($pSheet, $iSheetIndex);
    }

    /**
     * Get named ranges
     *
     * @return PHPExcel_NamedRange[]
     */
    public function getNamedRanges()
    {
        return $this->_namedRanges;
    }

    /**
     * Add named range
     *
     * @param  PHPExcel_NamedRange $namedRange
     * @return PHPExcel
     */
    public function addNamedRange(PHPExcel_NamedRange $namedRange)
    {
        if ($namedRange->getScope() == null) {
            // global scope
            $this->_namedRanges[$namedRange->getName()] = $namedRange;
        } else {
            // local scope
            $this->_namedRanges[$namedRange->getScope()->getTitle() . '!' . $namedRange->getName()] = $namedRange;
        }
        return true;
    }

    /**
     * Get named range
     *
     * @param  string $namedRange
     * @param  PHPExcel_Worksheet|null $pSheet Scope. Use null for global scope
     * @return PHPExcel_NamedRange|null
     */
    public function getNamedRange($namedRange, PHPExcel_Worksheet $pSheet = null)
    {
        $returnValue = null;

        if ($namedRange != '' && ($namedRange !== NULL)) {
            // first look for global defined name
            if (isset($this->_namedRanges[$namedRange])) {
                $returnValue = $this->_namedRanges[$namedRange];
            }

            // then look for local defined name (has priority over global defined name if both names exist)
            if (($pSheet !== NULL) && isset($this->_namedRanges[$pSheet->getTitle() . '!' . $namedRange])) {
                $returnValue = $this->_namedRanges[$pSheet->getTitle() . '!' . $namedRange];
            }
        }

        return $returnValue;
    }

    /**
     * Remove named range
     *
     * @param  string $namedRange
     * @param  PHPExcel_Worksheet|null $pSheet Scope: use null for global scope.
     * @return PHPExcel
     */
    public function removeNamedRange($namedRange, PHPExcel_Worksheet $pSheet = null)
    {
        if ($pSheet === NULL) {
            if (isset($this->_namedRanges[$namedRange])) {
                unset($this->_namedRanges[$namedRange]);
            }
        } else {
            if (isset($this->_namedRanges[$pSheet->getTitle() . '!' . $namedRange])) {
                unset($this->_namedRanges[$pSheet->getTitle() . '!' . $namedRange]);
            }
        }
        return $this;
    }

    /**
     * Get worksheet iterator
     *
     * @return PHPExcel_WorksheetIterator
     */
    public function getWorksheetIterator()
    {
        return new PHPExcel_WorksheetIterator($this);
    }

    /**
     * Copy workbook (!= clone!)
     *
     * @return PHPExcel
     */
    public function copy()
    {
        $copied = clone $this;

        $worksheetCount = count($this->_workSheetCollection);
        for ($i = 0; $i < $worksheetCount; ++$i) {
            $this->_workSheetCollection[$i] = $this->_workSheetCollection[$i]->copy();
            $this->_workSheetCollection[$i]->rebindParent($this);
        }

        return $copied;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        foreach ($this as $key => $val) {
            if (is_object($val) || (is_array($val))) {
                $this->{$key} = unserialize(serialize($val));
            }
        }
    }

    /**
     * Get the workbook collection of cellXfs
     *
     * @return PHPExcel_Style[]
     */
    public function getCellXfCollection()
    {
        return $this->_cellXfCollection;
    }

    /**
     * Get cellXf by index
     *
     * @param  int $pIndex
     * @return PHPExcel_Style
     */
    public function getCellXfByIndex($pIndex = 0)
    {
        return $this->_cellXfCollection[$pIndex];
    }

    /**
     * Get cellXf by hash code
     *
     * @param  string $pValue
     * @return PHPExcel_Style|false
     */
    public function getCellXfByHashCode($pValue = '')
    {
        foreach ($this->_cellXfCollection as $cellXf) {
            if ($cellXf->getHashCode() == $pValue) {
                return $cellXf;
            }
        }
        return false;
    }

    /**
     * Check if style exists in style collection
     *
     * @param  PHPExcel_Style $pCellStyle
     * @return boolean
     */
    public function cellXfExists($pCellStyle = null)
    {
        return in_array($pCellStyle, $this->_cellXfCollection, true);
    }

    /**
     * Get default style
     *
     * @return PHPExcel_Style
     * @throws PHPExcel_Exception
     */
    public function getDefaultStyle()
    {
        if (isset($this->_cellXfCollection[0])) {
            return $this->_cellXfCollection[0];
        }
        throw new PHPExcel_Exception('No default style found for this workbook');
    }

    /**
     * Add a cellXf to the workbook
     *
     * @param PHPExcel_Style $style
     */
    public function addCellXf(PHPExcel_Style $style)
    {
        $this->_cellXfCollection[] = $style;
        $style->setIndex(count($this->_cellXfCollection) - 1);
    }

    /**
     * Remove cellXf by index. It is ensured that all cells get their xf index updated.
     *
     * @param  int $pIndex Index to cellXf
     * @throws PHPExcel_Exception
     */
    public function removeCellXfByIndex($pIndex = 0)
    {
        if ($pIndex > count($this->_cellXfCollection) - 1) {
            throw new PHPExcel_Exception("CellXf index is out of bounds.");
        } else {
            // first remove the cellXf
            array_splice($this->_cellXfCollection, $pIndex, 1);

            // then update cellXf indexes for cells
            foreach ($this->_workSheetCollection as $worksheet) {
                foreach ($worksheet->getCellCollection(false) as $cellID) {
                    $cell = $worksheet->getCell($cellID);
                    $xfIndex = $cell->getXfIndex();
                    if ($xfIndex > $pIndex) {
                        // decrease xf index by 1
                        $cell->setXfIndex($xfIndex - 1);
                    } else if ($xfIndex == $pIndex) {
                        // set to default xf index 0
                        $cell->setXfIndex(0);
                    }
                }
            }
        }
    }

    /**
     * Get the cellXf supervisor
     *
     * @return PHPExcel_Style
     */
    public function getCellXfSupervisor()
    {
        return $this->_cellXfSupervisor;
    }

    /**
     * Get the workbook collection of cellStyleXfs
     *
     * @return PHPExcel_Style[]
     */
    public function getCellStyleXfCollection()
    {
        return $this->_cellStyleXfCollection;
    }

    /**
     * Get cellStyleXf by index
     *
     * @param  int $pIndex
     * @return PHPExcel_Style
     */
    public function getCellStyleXfByIndex($pIndex = 0)
    {
        return $this->_cellStyleXfCollection[$pIndex];
    }

    /**
     * Get cellStyleXf by hash code
     *
     * @param  string $pValue
     * @return PHPExcel_Style|false
     */
    public function getCellStyleXfByHashCode($pValue = '')
    {
        foreach ($this->_cellXfStyleCollection as $cellStyleXf) {
            if ($cellStyleXf->getHashCode() == $pValue) {
                return $cellStyleXf;
            }
        }
        return false;
    }

    /**
     * Add a cellStyleXf to the workbook
     *
     * @param PHPExcel_Style $pStyle
     */
    public function addCellStyleXf(PHPExcel_Style $pStyle)
    {
        $this->_cellStyleXfCollection[] = $pStyle;
        $pStyle->setIndex(count($this->_cellStyleXfCollection) - 1);
    }

    /**
     * Remove cellStyleXf by index
     *
     * @param int $pIndex
     * @throws PHPExcel_Exception
     */
    public function removeCellStyleXfByIndex($pIndex = 0)
    {
        if ($pIndex > count($this->_cellStyleXfCollection) - 1) {
            throw new PHPExcel_Exception("CellStyleXf index is out of bounds.");
        } else {
            array_splice($this->_cellStyleXfCollection, $pIndex, 1);
        }
    }

    /**
     * Eliminate all unneeded cellXf and afterwards update the xfIndex for all cells
     * and columns in the workbook
     */
    public function garbageCollect()
    {
        // how many references are there to each cellXf ?
        $countReferencesCellXf = array();
        foreach ($this->_cellXfCollection as $index => $cellXf) {
            $countReferencesCellXf[$index] = 0;
        }

        foreach ($this->getWorksheetIterator() as $sheet) {

            // from cells
            foreach ($sheet->getCellCollection(false) as $cellID) {
                $cell = $sheet->getCell($cellID);
                ++$countReferencesCellXf[$cell->getXfIndex()];
            }

            // from row dimensions
            foreach ($sheet->getRowDimensions() as $rowDimension) {
                if ($rowDimension->getXfIndex() !== null) {
                    ++$countReferencesCellXf[$rowDimension->getXfIndex()];
                }
            }

            // from column dimensions
            foreach ($sheet->getColumnDimensions() as $columnDimension) {
                ++$countReferencesCellXf[$columnDimension->getXfIndex()];
            }
        }

        // remove cellXfs without references and create mapping so we can update xfIndex
        // for all cells and columns
        $countNeededCellXfs = 0;
        foreach ($this->_cellXfCollection as $index => $cellXf) {
            if ($countReferencesCellXf[$index] > 0 || $index == 0) { // we must never remove the first cellXf
                ++$countNeededCellXfs;
            } else {
                unset($this->_cellXfCollection[$index]);
            }
            $map[$index] = $countNeededCellXfs - 1;
        }
        $this->_cellXfCollection = array_values($this->_cellXfCollection);

        // update the index for all cellXfs
        foreach ($this->_cellXfCollection as $i => $cellXf) {
            $cellXf->setIndex($i);
        }

        // make sure there is always at least one cellXf (there should be)
        if (empty($this->_cellXfCollection)) {
            $this->_cellXfCollection[] = new PHPExcel_Style();
        }

        // update the xfIndex for all cells, row dimensions, column dimensions
        foreach ($this->getWorksheetIterator() as $sheet) {

            // for all cells
            foreach ($sheet->getCellCollection(false) as $cellID) {
                $cell = $sheet->getCell($cellID);
                $cell->setXfIndex($map[$cell->getXfIndex()]);
            }

            // for all row dimensions
            foreach ($sheet->getRowDimensions() as $rowDimension) {
                if ($rowDimension->getXfIndex() !== null) {
                    $rowDimension->setXfIndex($map[$rowDimension->getXfIndex()]);
                }
            }

            // for all column dimensions
            foreach ($sheet->getColumnDimensions() as $columnDimension) {
                $columnDimension->setXfIndex($map[$columnDimension->getXfIndex()]);
            }

            // also do garbage collection for all the sheets
            $sheet->garbageCollect();
        }
    }

    /**
     * Return the unique ID value assigned to this spreadsheet workbook
     *
     * @return string
     */
    public function getID()
    {
        return $this->_uniqueID;
    }

    /**
     * 处理订单合并相同列
     */
    public function from_array_merge_same($data, $startCell = 'A1', $col_name)
    {
        if (is_array($data)) {
            //把一围数组转二围数组便于循环
            if (!is_array(end($data))) {
                $source = array($data);
            }

            if (preg_match("/^([$]?[A-Z]{1,3})([$]?\d{1,7})$/", $startCell, $matches)) {
                list ($startColumn, $startRow) = array($matches[1], $matches[2]);
            }

            $tmp = $data[0][$col_name];//临时取第一个元素,便于对比找出第一个不同的元素，找出后tmp被赋值这个找到的值，继续找下去
            $begin = 0;//开始下标
            $end = 0;//结束下标

            for ($i = 0; $i <= count($data); $i++) {

                if (!isset($data[$i][$col_name])) {//判断循环是否结束
                    $end = $i - 1;//如果结束取最后一位作为end
                    $result['A' . ($begin + 2) . ':A' . ($end + 2)] = 'A' . ($begin + 2) . ':A' . ($end + 2);//把start和end推入数组
                    $result['B' . ($begin + 2) . ':B' . ($end + 2)] = 'B' . ($begin + 2) . ':B' . ($end + 2);
                    $result['H' . ($begin + 2) . ':H' . ($end + 2)] = 'H' . ($begin + 2) . ':H' . ($end + 2);
                    $result['I' . ($begin + 2) . ':I' . ($end + 2)] = 'I' . ($begin + 2) . ':I' . ($end + 2);
                    $result['J' . ($begin + 2) . ':J' . ($end + 2)] = 'J' . ($begin + 2) . ':J' . ($end + 2);
                    $result['K' . ($begin + 2) . ':K' . ($end + 2)] = 'K' . ($begin + 2) . ':K' . ($end + 2);
                    $result['L' . ($begin + 2) . ':L' . ($end + 2)] = 'L' . ($begin + 2) . ':L' . ($end + 2);
                    $result['M' . ($begin + 2) . ':M' . ($end + 2)] = 'M' . ($begin + 2) . ':M' . ($end + 2);
                    $result['N' . ($begin + 2) . ':N' . ($end + 2)] = 'N' . ($begin + 2) . ':N' . ($end + 2);
                    $result['O' . ($begin + 2) . ':O' . ($end + 2)] = 'O' . ($begin + 2) . ':O' . ($end + 2);
                    $result['P' . ($begin + 2) . ':P' . ($end + 2)] = 'P' . ($begin + 2) . ':P' . ($end + 2);
                    $result['Q' . ($begin + 2) . ':Q' . ($end + 2)] = 'Q' . ($begin + 2) . ':Q' . ($end + 2);
                    $result['R' . ($begin + 2) . ':R' . ($end + 2)] = 'R' . ($begin + 2) . ':R' . ($end + 2);
                    $result['S' . ($begin + 2) . ':S' . ($end + 2)] = 'S' . ($begin + 2) . ':S' . ($end + 2);
                    $result['T' . ($begin + 2) . ':T' . ($end + 2)] = 'T' . ($begin + 2) . ':T' . ($end + 2);
                    $result['U' . ($begin + 2) . ':U' . ($end + 2)] = 'U' . ($begin + 2) . ':U' . ($end + 2);
                    $result['V' . ($begin + 2) . ':V' . ($end + 2)] = 'V' . ($begin + 2) . ':V' . ($end + 2);
                    $result['W' . ($begin + 2) . ':W' . ($end + 2)] = 'W' . ($begin + 2) . ':W' . ($end + 2);
                    $result['X' . ($begin + 2) . ':X' . ($end + 2)] = 'X' . ($begin + 2) . ':X' . ($end + 2);
                    $result['Y' . ($begin + 2) . ':Y' . ($end + 2)] = 'Y' . ($begin + 2) . ':Y' . ($end + 2);
                    $result['Z' . ($begin + 2) . ':Z' . ($end + 2)] = 'Z' . ($begin + 2) . ':Z' . ($end + 2);

                    $result['AA' . ($begin + 2) . ':AA' . ($end + 2)] = 'AA' . ($begin + 2) . ':AA' . ($end + 2);
                    $result['AB' . ($begin + 2) . ':AB' . ($end + 2)] = 'AB' . ($begin + 2) . ':AB' . ($end + 2);
                    $result['AC' . ($begin + 2) . ':AC' . ($end + 2)] = 'AC' . ($begin + 2) . ':AC' . ($end + 2);
                    $result['AD' . ($begin + 2) . ':AD' . ($end + 2)] = 'AD' . ($begin + 2) . ':AD' . ($end + 2);
                    $result['AE' . ($begin + 2) . ':AE' . ($end + 2)] = 'AE' . ($begin + 2) . ':AE' . ($end + 2);
                    $result['AF' . ($begin + 2) . ':AF' . ($end + 2)] = 'AF' . ($begin + 2) . ':AF' . ($end + 2);
                    $result['AG' . ($begin + 2) . ':AG' . ($end + 2)] = 'AG' . ($begin + 2) . ':AG' . ($end + 2);
                    $result['AH' . ($begin + 2) . ':AH' . ($end + 2)] = 'AH' . ($begin + 2) . ':AH' . ($end + 2);
                    $result['AI' . ($begin + 2) . ':AI' . ($end + 2)] = 'AI' . ($begin + 2) . ':AI' . ($end + 2);
                    $result['AJ' . ($begin + 2) . ':AJ' . ($end + 2)] = 'AJ' . ($begin + 2) . ':AJ' . ($end + 2);
                    $result['AK' . ($begin + 2) . ':AK' . ($end + 2)] = 'AK' . ($begin + 2) . ':AK' . ($end + 2);
                    $result['AL' . ($begin + 2) . ':AL' . ($end + 2)] = 'AL' . ($begin + 2) . ':AL' . ($end + 2);
                    $result['AM' . ($begin + 2) . ':AM' . ($end + 2)] = 'AM' . ($begin + 2) . ':AM' . ($end + 2);
                    $result['AN' . ($begin + 2) . ':AN' . ($end + 2)] = 'AN' . ($begin + 2) . ':AN' . ($end + 2);
                    $result['AO' . ($begin + 2) . ':AO' . ($end + 2)] = 'AO' . ($begin + 2) . ':AO' . ($end + 2);
                    break;
                }

                $currentColumn = $startColumn;
                foreach ($data[$i] as $v) {
                    $this->getActiveSheet()->setCellValue($currentColumn . $startRow, $v);//插入数据
                    ++$currentColumn;
                }
                ++$startRow;

                //开始查询合并start end 数组

                if ($data[$i][$col_name] !== $tmp) {//判断元素是否不等于临时值
                    $end = $i - 1;//如果找到几下end值
                    if ($begin !== $end) {//如果只有一个值start就和end相同了要排除
                        $result['A' . ($begin + 2) . ':A' . ($end + 2)] = 'A' . ($begin + 2) . ':A' . ($end + 2);
                        $result['B' . ($begin + 2) . ':B' . ($end + 2)] = 'B' . ($begin + 2) . ':B' . ($end + 2);
                        $result['H' . ($begin + 2) . ':H' . ($end + 2)] = 'H' . ($begin + 2) . ':H' . ($end + 2);
                        $result['I' . ($begin + 2) . ':I' . ($end + 2)] = 'I' . ($begin + 2) . ':I' . ($end + 2);
                        $result['J' . ($begin + 2) . ':J' . ($end + 2)] = 'J' . ($begin + 2) . ':J' . ($end + 2);
                        $result['K' . ($begin + 2) . ':K' . ($end + 2)] = 'K' . ($begin + 2) . ':K' . ($end + 2);
                        $result['L' . ($begin + 2) . ':L' . ($end + 2)] = 'L' . ($begin + 2) . ':L' . ($end + 2);
                        $result['M' . ($begin + 2) . ':M' . ($end + 2)] = 'M' . ($begin + 2) . ':M' . ($end + 2);
                        $result['N' . ($begin + 2) . ':N' . ($end + 2)] = 'N' . ($begin + 2) . ':N' . ($end + 2);
                        $result['O' . ($begin + 2) . ':O' . ($end + 2)] = 'O' . ($begin + 2) . ':O' . ($end + 2);
                        $result['P' . ($begin + 2) . ':P' . ($end + 2)] = 'P' . ($begin + 2) . ':P' . ($end + 2);
                        $result['Q' . ($begin + 2) . ':Q' . ($end + 2)] = 'Q' . ($begin + 2) . ':Q' . ($end + 2);
                        $result['R' . ($begin + 2) . ':R' . ($end + 2)] = 'R' . ($begin + 2) . ':R' . ($end + 2);
                        $result['S' . ($begin + 2) . ':S' . ($end + 2)] = 'S' . ($begin + 2) . ':S' . ($end + 2);
                        $result['T' . ($begin + 2) . ':T' . ($end + 2)] = 'T' . ($begin + 2) . ':T' . ($end + 2);
                        $result['U' . ($begin + 2) . ':U' . ($end + 2)] = 'U' . ($begin + 2) . ':U' . ($end + 2);
                        $result['V' . ($begin + 2) . ':V' . ($end + 2)] = 'V' . ($begin + 2) . ':V' . ($end + 2);
                        $result['W' . ($begin + 2) . ':W' . ($end + 2)] = 'W' . ($begin + 2) . ':W' . ($end + 2);
                        $result['X' . ($begin + 2) . ':X' . ($end + 2)] = 'X' . ($begin + 2) . ':X' . ($end + 2);
                        $result['Y' . ($begin + 2) . ':Y' . ($end + 2)] = 'Y' . ($begin + 2) . ':Y' . ($end + 2);
                        $result['Z' . ($begin + 2) . ':Z' . ($end + 2)] = 'Z' . ($begin + 2) . ':Z' . ($end + 2);

                        $result['AA' . ($begin + 2) . ':AA' . ($end + 2)] = 'AA' . ($begin + 2) . ':AA' . ($end + 2);
                        $result['AB' . ($begin + 2) . ':AB' . ($end + 2)] = 'AB' . ($begin + 2) . ':AB' . ($end + 2);
                        $result['AC' . ($begin + 2) . ':AC' . ($end + 2)] = 'AC' . ($begin + 2) . ':AC' . ($end + 2);
                        $result['AD' . ($begin + 2) . ':AD' . ($end + 2)] = 'AD' . ($begin + 2) . ':AD' . ($end + 2);
                        $result['AE' . ($begin + 2) . ':AE' . ($end + 2)] = 'AE' . ($begin + 2) . ':AE' . ($end + 2);
                        $result['AF' . ($begin + 2) . ':AF' . ($end + 2)] = 'AF' . ($begin + 2) . ':AF' . ($end + 2);
                        $result['AG' . ($begin + 2) . ':AG' . ($end + 2)] = 'AG' . ($begin + 2) . ':AG' . ($end + 2);
                        $result['AH' . ($begin + 2) . ':AH' . ($end + 2)] = 'AH' . ($begin + 2) . ':AH' . ($end + 2);
                        $result['AI' . ($begin + 2) . ':AI' . ($end + 2)] = 'AI' . ($begin + 2) . ':AI' . ($end + 2);
                        $result['AJ' . ($begin + 2) . ':AJ' . ($end + 2)] = 'AJ' . ($begin + 2) . ':AJ' . ($end + 2);

                        $result['AK' . ($begin + 2) . ':AK' . ($end + 2)] = 'AK' . ($begin + 2) . ':AK' . ($end + 2);
                        $result['AL' . ($begin + 2) . ':AL' . ($end + 2)] = 'AL' . ($begin + 2) . ':AL' . ($end + 2);
                        $result['AM' . ($begin + 2) . ':AM' . ($end + 2)] = 'AM' . ($begin + 2) . ':AM' . ($end + 2);
                        $result['AN' . ($begin + 2) . ':AN' . ($end + 2)] = 'AN' . ($begin + 2) . ':AN' . ($end + 2);
                        $result['AO' . ($begin + 2) . ':AO' . ($end + 2)] = 'AO' . ($begin + 2) . ':AO' . ($end + 2);
                    }
                    $tmp = $data[$i][$col_name];//推入一次后把tmp赋新值继续比较下去
                    $begin = $i;//推入一次后把bgin赋新值继续比较下去
                }

            }
            $get_merge = $this->getActiveSheet()->getMergeCells();
            $this->getActiveSheet()->setMergeCells(array_merge($get_merge, $result));//合并相同列
        }
    }
}
