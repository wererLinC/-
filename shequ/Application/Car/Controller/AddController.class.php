<?php
namespace Car\Controller;
use Think\Controller;
use PHPExcel_IOFactory;
use PHPExcel;
use Behavior;
class AddController extends CommonController {
    public function index(){
        $this->display();
    }

    public function getInfo(){
        //通过cardId获取房屋信息,这里我只要求一个就好
        $maps = $_POST;
        $maps['community'] = $_SESSION[admin][community];
        $res = M('house')->where($maps)->limit(1)->find();
       if ($res){
           return show(1,'车主相关信息',$res);
       }else{
           return show(0,'没有相关信息');
       }
    }

    public function add(){
        $res = D('car')->insertCar($_POST);
        if($res){
            return show(1,'添加成功');
        }else{
            return show(0,'添加失败');
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
            $carCount = M('car')->order("id desc")->limit(1)->getField('id');
            for ($i = 2; $i <= $highestRow; $i++) {
                ++$carCount;
                //看这里看这里,前面小写的a是表中的字段名，后面的大写A是excel中位置
                $data['carType'] =$objPHPExcel->getActiveSheet()->getCell("G" . $i)->getValue();
                $data['carBrand'] =$objPHPExcel->getActiveSheet()->getCell("E" .$i)->getValue();
                $data['carId'] =$objPHPExcel->getActiveSheet()->getCell("F" .$i)->getValue();
                $data['name'] = $objPHPExcel->getActiveSheet()->getCell("C". $i)->getValue();
                $data['cardId'] = $objPHPExcel->getActiveSheet()->getCell("B". $i)->getValue();
                $data['id'] = $carCount;
                $data['phone'] = $objPHPExcel->getActiveSheet()->getCell("D". $i)->getValue();
                $data['community'] = $community;
                //看这里看这里,这个位置写数据库中的表名
                $result = M('car')->add($data);
                if(!$result){
                    $this->error("数据插入失败");
                }else{
                    print_r($result);
                }
            }
            $this->success('导入成功!','/index.php?m=car&c=list&a=index','3');
        } else {
            $this->error("请选择上传的文件");
        }
    }

}