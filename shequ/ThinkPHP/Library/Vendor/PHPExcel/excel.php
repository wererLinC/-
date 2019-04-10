<?php
/**
 * Author: Kevin
 * Date: 2015/07/20
 * Time: 22:25
 */

namespace common\vendor\phpexcel;

use common\services\fx\SettingService;

require_once('PHPExcel.php');
require_once('PHPExcel/Autoloader.php');
require_once('PHPExcel/Reader/Excel5.php');

class excel
{

    /**处理订单导出专用
     * @param $data
     * @param string $fileName
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */

    static public function downOrder($data, $fileName = 'data.xsl')
    {
        $objPHPExcel = new \PHPExcel();
        $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array( 'cacheTime'  => 6000 );
        \PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        $objPHPExcel->getActiveSheet()->fromArray($data[0], null, 'A1');//表格头部
        $objPHPExcel->getActiveSheet()->setTitle('订单数据');//表格标题
        $objPHPExcel->setActiveSheetIndex(0);
        //设置宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(28);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(13);

        //水平居中
        $objPHPExcel->getActiveSheet()->getStyle('A1:AO1')->applyFromArray(
            array(
                'alignment' => array(
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            )
        );
        //垂直居中
        $objPHPExcel->getActiveSheet()->getStyle('A:AO')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:AO1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1:AO1')->getFill()->getStartColor()->setARGB('FFE6E6FA');
        unset($data[0]);

        $objPHPExcel->from_array_merge_same(array_merge($data), $startCell = 'A2', '0');//插入数据合并相同
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    static public function download($data, $fileName = 'data.xsl')
    {
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');
        $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public static function toArray($file)
    {
        $objPHPExcel = \PHPExcel_IOFactory::load($file);
        return $objPHPExcel->getSheet(0)->toArray(null, true, true, true);
    }

    static public function getExcelData($excelFile = null)
    {
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($excelFile);
        $sheet = $objPHPExcel->getSheet(0);//获取第一个工作表
        $highestRow = $sheet->getHighestRow();//取得总行数
        $highestColumn = $sheet->getHighestColumn(); //取得总列数

        $data = [];
        for ($j = 1; $j <= $highestRow; $j++) { //从第1行开始
            $arrResult = '';
            for ($k = 'A'; $k <= $highestColumn; $k++) {
                //读取单元格
                $arrResult .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue() . ',';
            }
            $arrResult = rtrim($arrResult, ",");
            $data[] = explode(",", $arrResult);
        }
        return $data;
    }

}