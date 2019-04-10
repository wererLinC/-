<?php
namespace House\Controller;
use Think\Controller;
class AddController extends CommonController {
    public function index(){
        $this->display();
    }

    public function add(){
	$data = $_POST;
        $buildNum = $_POST['buildNum'];
        $unitNum = $_POST['unitNum'];
        $roomNum = $_POST['roomNum'];
        $cardId = $_POST['cardId'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        if(!$buildNum){
            return show(0,"楼栋号不能为空");
        }
        if(!$unitNum){
            return show(0,"单元号不能为空");
        }
        if(!$roomNum){
            return show(0,"室号不能为空");
        }
        if(!$cardId){
            return show(0,"身份证号码不能为空");
        }
        if(!$name){
            return show(0,"名字不能为空");
        }
        if(!$phone){
            return show(0,"手机号码不能为空");
        }

        $result = D('house')->insertHouse($_POST);
        //把房屋信息插入授给表中
        if($_POST['roomType']==1||$_POST['roomType']==2){
	    $data['money'] = 0;
	    $data['isCharge'] = 0;
            $charge = M('charge')->add($data);
        }else{
        }

        if($result){
            return show(1,"添加成功，继续添加？？");
        }else{
            return show(0,"添加失败");
        }
    }

    //导入表格页面
    public function excel(){
        $community = M('community')->select();

        $this->assign('community',$community);
        $this->display();
    }

    //导入表格方法
    public function addExcel(){
        ini_set('memory_limit','1024M');
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
            $houseCount = M('house')->order("id desc")->limit(1)->getField('id');
            for ($i = 2; $i <= $highestRow; $i++) {
                ++$houseCount;
                //看这里看这里,前面小写的a是表中的字段名，后面的大写A是excel中位置
                $data['name'] =$objPHPExcel->getActiveSheet()->getCell("G" . $i)->getValue();
                $data['roomNum'] =$objPHPExcel->getActiveSheet()->getCell("E" .$i)->getValue();
                $data['cardId'] =$objPHPExcel->getActiveSheet()->getCell("F" .$i)->getValue();
                $data['buildNum'] = $objPHPExcel->getActiveSheet()->getCell("C". $i)->getValue();
                $data['address'] = $objPHPExcel->getActiveSheet()->getCell("B". $i)->getValue();
                $data['id'] = $houseCount;
                $data['unitNum'] = $objPHPExcel->getActiveSheet()->getCell("D". $i)->getValue();
                $data['phone'] = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                $data['area'] = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue();
                $data['roomType'] = $objPHPExcel->getActiveSheet()->getCell("J". $i)->getValue();

                $data['community'] = $community;
                //看这里看这里,这个位置写数据库中的表名
                $result = M('house')->add($data);
                if(!$result){
                    $this->error("数据插入失败");
                }else{
                    print_r($result);
                }
            }
            $this->success('导入成功!','/index.php?m=house&c=list&a=index','3');
        } else {
            $this->error("请选择上传的文件");
        }
    }

}