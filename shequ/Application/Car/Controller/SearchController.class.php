<?php
namespace Car\Controller;
use Think\Controller;
class SearchController extends CommonController {
    public function index(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        $carId = $_GET['carId'];
        if($name&&$cardId==null&&$carId==null){
            $map['community'] = $_SESSION[admin][community];
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('car')->where($map)->select();
        }else if ($name==null&&$cardId&&$carId==null){
            $map['community'] = $_SESSION[admin][community];
            $map['cardId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('car')->where($map)->select();
        }else if($name==null&&$cardId==null&&$carId){
            $map['community'] = $_SESSION[admin][community];
            $map['carId'] = array("LIKE", '%' . $carId . '%');
            $res = M('car')->where($map)->select();
        }
        $this->assign("carInfo",$res);
        $this->display();
    }
}