<?php
namespace People\Controller;
use Think\Controller;
class ExcelController extends CommonController {
    //长住户/户籍户导入表格页面
    public function index(){
        $community = M('community')->select();

        $this->assign('community',$community);
        $this->display();
    }

    //长住户/户籍户导入表格方法
    public function addIndex(){
        ini_set('memory_limit','1024M');
        $roomType = $_POST['roomType'];
        $community = $_POST['community'];
        if (!empty($_FILES)) {
            $config = array(
                'exts' => array('xlsx','xls'),
                'maxSize' => 3145728000,
                'rootPath' =>"./Uploads/",
                'savePath' => 'excel/',
                'subName' => array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);
            if (!$info = $upload->upload()) {
                $this->error($upload->getError());
            }

            vendor("PHPExcel.PHPExcel");
            $file_name="./Uploads/".$info['excelName']['savepath'].$info['excelName']['savename'];
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
            if ($extension == 'xlsx') {
                $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            } else if ($extension == 'xls'){
                $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            }

            $sheet =$objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();//取得总行数
            $highestColumn =$sheet->getHighestColumn(); //取得总列数
            $indexCount = M('people')->order("id desc")->limit(1)->getField('id');
            for ($i = 2; $i <= $highestRow; $i++) {
                ++$indexCount;
                //看这里看这里,前面小写的a是表中的字段名，后面的大写A是excel中位置
                $data['cardId'] = $objPHPExcel->getActiveSheet()->getCell("B". $i)->getValue();
                $data['name'] = $objPHPExcel->getActiveSheet()->getCell("C". $i)->getValue();
                $data['sex'] =$objPHPExcel->getActiveSheet()->getCell("D" .$i)->getValue();
                $data['ownerName'] =$objPHPExcel->getActiveSheet()->getCell("E" .$i)->getValue();
                $data['ownerRelative'] =$objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
                $data['origin'] = $objPHPExcel->getActiveSheet()->getCell("G". $i)->getValue();
                $data['birthLand'] = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                $data['workLand'] = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue();
                $data['nation'] = $objPHPExcel->getActiveSheet()->getCell("J". $i)->getValue();
                $data['marrige'] = $objPHPExcel->getActiveSheet()->getCell("K". $i)->getValue();
                $data['culture'] = $objPHPExcel->getActiveSheet()->getCell("L". $i)->getValue();
                $data['policy'] = $objPHPExcel->getActiveSheet()->getCell("M". $i)->getValue();
                $data['party'] = $objPHPExcel->getActiveSheet()->getCell("N". $i)->getValue();
                $data['army'] = $objPHPExcel->getActiveSheet()->getCell("O". $i)->getValue();
                $data['feature'] = $objPHPExcel->getActiveSheet()->getCell("P". $i)->getValue();
                $data['position'] = $objPHPExcel->getActiveSheet()->getCell("Q". $i)->getValue();
                $data['interest'] = $objPHPExcel->getActiveSheet()->getCell("R". $i)->getValue();
                $data['featureDes'] = $objPHPExcel->getActiveSheet()->getCell("S". $i)->getValue();
                $data['picture'] = $objPHPExcel->getActiveSheet()->getCell("T". $i)->getValue();

                $data['isDel'] = 0;
                $data['id'] = $indexCount;
                $data['roomType'] = $roomType;
                $data['community'] = $community;
                //看这里看这里,这个位置写数据库中的表名
                $result = M('people')->add($data);
                if(!$result){
                    $this->error("数据插入失败");
                }else{
                    print_r($result);
                }
            }
            $this->success('导入成功!','/index.php?m=people&c=list&a=index','3');
        } else {
            $this->error("请选择上传的文件");
        }
    }


//户籍户导入表格页面
    public function huji(){
        $community = M('community')->select();

        $this->assign('community',$community);
        $this->display();
    }

    //长住户/户籍户导入表格方法
    public function addHuji(){
        ini_set('memory_limit','1024M');
        $roomType = $_POST['roomType'];
        $community = $_POST['community'];
        if (!empty($_FILES)) {
            $config = array(
                'exts' => array('xlsx','xls'),
                'maxSize' => 3145728000,
                'rootPath' =>"./Uploads/",
                'savePath' => 'excel/',
                'subName' => array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);
            if (!$info = $upload->upload()) {
                $this->error($upload->getError());
            }

            vendor("PHPExcel.PHPExcel");
            $file_name="./Uploads/".$info['excelName']['savepath'].$info['excelName']['savename'];
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
            if ($extension == 'xlsx') {
                $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            } else if ($extension == 'xls'){
                $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            }

            $sheet =$objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();//取得总行数
            $highestColumn =$sheet->getHighestColumn(); //取得总列数
            $indexCount = M('people')->order("id desc")->limit(1)->getField('id');
            for ($i = 2; $i <= $highestRow; $i++) {
                ++$indexCount;
                //看这里看这里,前面小写的a是表中的字段名，后面的大写A是excel中位置
                $data['cardId'] = $objPHPExcel->getActiveSheet()->getCell("B". $i)->getValue();
                $data['name'] = $objPHPExcel->getActiveSheet()->getCell("C". $i)->getValue();
                $data['sex'] =$objPHPExcel->getActiveSheet()->getCell("D" .$i)->getValue();
                $data['ownerName'] =$objPHPExcel->getActiveSheet()->getCell("E" .$i)->getValue();
                $data['ownerRelative'] =$objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
                $data['origin'] = $objPHPExcel->getActiveSheet()->getCell("G". $i)->getValue();
                $data['birthLand'] = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                $data['workLand'] = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue();
                $data['nation'] = $objPHPExcel->getActiveSheet()->getCell("J". $i)->getValue();
                $data['marrige'] = $objPHPExcel->getActiveSheet()->getCell("K". $i)->getValue();
                $data['culture'] = $objPHPExcel->getActiveSheet()->getCell("L". $i)->getValue();
                $data['policy'] = $objPHPExcel->getActiveSheet()->getCell("M". $i)->getValue();
                $data['party'] = $objPHPExcel->getActiveSheet()->getCell("N". $i)->getValue();
                $data['army'] = $objPHPExcel->getActiveSheet()->getCell("O". $i)->getValue();
                $data['feature'] = $objPHPExcel->getActiveSheet()->getCell("P". $i)->getValue();
                $data['position'] = $objPHPExcel->getActiveSheet()->getCell("Q". $i)->getValue();
                $data['interest'] = $objPHPExcel->getActiveSheet()->getCell("R". $i)->getValue();
                $data['featureDes'] = $objPHPExcel->getActiveSheet()->getCell("S". $i)->getValue();
                $data['picture'] = $objPHPExcel->getActiveSheet()->getCell("T". $i)->getValue();

                $data['isDel'] = 0;
                $data['id'] = $indexCount;
                $data['roomType'] = $roomType;
                $data['community'] = $community;
                //看这里看这里,这个位置写数据库中的表名
                $result = M('people')->add($data);
                if(!$result){
                    $this->error("数据插入失败");
                }else{
                    print_r($result);
                }
            }
            $this->success('导入成功!','/index.php?m=people&c=list&a=huji','3');
        } else {
            $this->error("请选择上传的文件");
        }
    }

    //暂住户导入表格页面
    public function zanzhu(){
        $community = M('community')->select();

        $this->assign('community',$community);
        $this->display();
    }

    //暂住户导入表格方法
    public function addZanzhu(){
        ini_set('memory_limit','1024M');
        $roomType = $_POST['roomType'];
        $community = $_POST['community'];
        if (!empty($_FILES)) {
            $config = array(
                'exts' => array('xlsx','xls'),
                'maxSize' => 3145728000,
                'rootPath' =>"./Uploads/",
                'savePath' => 'excel/',
                'subName' => array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);
            if (!$info = $upload->upload()) {
                $this->error($upload->getError());
            }

            vendor("PHPExcel.PHPExcel");
            $file_name="./Uploads/".$info['excelName']['savepath'].$info['excelName']['savename'];
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
            if ($extension == 'xlsx') {
                $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            } else if ($extension == 'xls'){
                $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            }

            $sheet =$objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();//取得总行数
            $highestColumn =$sheet->getHighestColumn(); //取得总列数
            $zanzhuCount = M('zanzhu')->order("id desc")->limit(1)->getField('id');
            for ($i = 2; $i <= $highestRow; $i++) {
                ++$zanzhuCount;
                //看这里看这里,前面小写的a是表中的字段名，后面的大写A是excel中位置
                $data['buildNum'] = $objPHPExcel->getActiveSheet()->getCell("B". $i)->getValue();
                $data['unitNum'] = $objPHPExcel->getActiveSheet()->getCell("C". $i)->getValue();
                $data['roomNum'] =$objPHPExcel->getActiveSheet()->getCell("D" .$i)->getValue();
                $data['cardId'] =$objPHPExcel->getActiveSheet()->getCell("E" .$i)->getValue();
                $data['name'] =$objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
                $data['sex'] = $objPHPExcel->getActiveSheet()->getCell("G". $i)->getValue();
                $data['phone'] = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                $data['birthLand'] = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue();
                $data['workLand'] = $objPHPExcel->getActiveSheet()->getCell("J". $i)->getValue();
                $data['position'] = $objPHPExcel->getActiveSheet()->getCell("K". $i)->getValue();
                $data['policy'] = $objPHPExcel->getActiveSheet()->getCell("L". $i)->getValue();

                $data['isDel'] = 0;
                $data['id'] = $zanzhuCount;
                $data['roomType'] = $roomType;
                $data['community'] = $community;
                //看这里看这里,这个位置写数据库中的表名
                $result = M('zanzhu')->add($data);
                if(!$result){
                    $this->error("数据插入失败");
                }else{
                    print_r($result);
                }
            }
            $this->success('导入成功!','/index.php?m=people&c=list&a=zanzhu','3');
        } else {
            $this->error("请选择上传的文件");
        }
    }

    //侨联导入表格页面
    public function qiaolian(){
        $community = M('community')->select();

        $this->assign('community',$community);
        $this->display();
    }

    //侨联导入表格方法
    public function addQiaolian()
    {
        ini_set('memory_limit', '1024M');
        $roomType = $_POST['roomType'];
        $community = $_POST['community'];
        if (!empty($_FILES)) {
            $config = array(
                'exts' => array('xlsx', 'xls'),
                'maxSize' => 3145728000,
                'rootPath' => "./Uploads/",
                'savePath' => 'excel/',
                'subName' => array('date', 'Ymd'),
            );
            $upload = new \Think\Upload($config);
            if (!$info = $upload->upload()) {
                $this->error($upload->getError());
            }

            vendor("PHPExcel.PHPExcel");
            $file_name = "./Uploads/" . $info['excelName']['savepath'] . $info['excelName']['savename'];
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
            if ($extension == 'xlsx') {
                $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load($file_name, $encode = 'utf-8');
            } else if ($extension == 'xls') {
                $objReader = \PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel = $objReader->load($file_name, $encode = 'utf-8');
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();//取得总行数
            $highestColumn = $sheet->getHighestColumn(); //取得总列数
            $zanzhuCount = M('qiaolian')->order("id desc")->limit(1)->getField('id');
            for ($i = 2; $i <= $highestRow; $i++) {
                ++$zanzhuCount;
                //看这里看这里,前面小写的a是表中的字段名，后面的大写A是excel中位置
                $data['name'] = $objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
                $data['ownerName'] = $objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
                $data['ownerRelative'] = $objPHPExcel->getActiveSheet()->getCell("D" . $i)->getValue();
                $data['country'] = $objPHPExcel->getActiveSheet()->getCell("E" . $i)->getValue();
                $data['type'] = $objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();

                $data['isDel'] = 0;
                $data['id'] = $zanzhuCount;
                $data['community'] = $community;
                //看这里看这里,这个位置写数据库中的表名
                $result = M('qiaolian')->add($data);
                if (!$result) {
                    $this->error("数据插入失败");
                } else {
                    print_r($result);
                }
            }
            $this->success('导入成功!', '/index.php?m=people&c=list&a=qiaolian', '3');
        } else {
            $this->error("请选择上传的文件");
        }
    }
}