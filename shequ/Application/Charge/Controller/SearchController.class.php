<?php
namespace Charge\Controller;
use Think\Controller;
class SearchController extends CommonController {
    public function index(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        if($name&&$cardId==null){
            $map['community'] = $_SESSION[admin][community];
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('charge')->where($map)->select();
        }else if ($name==null&&$cardId){
            $map['community'] = $_SESSION[admin][community];
            $map['carId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('charge')->where($map)->select();
        }
        $this->assign("chargeInfo",$res);
        $this->display();
    }
}