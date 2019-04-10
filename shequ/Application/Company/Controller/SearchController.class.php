<?php
namespace Company\Controller;
use Think\Controller;
class SearchController extends CommonController {
    public function index(){
        $useName = $_GET['useName'];
        $useCardId = $_GET['useCardId'];
        if($useName&&$useCardId==null){
            $map['community'] = $_SESSION[admin][community];
            $map['useName'] = array("LIKE", '%' . $useName . '%');
            $res = M('company')->where($map)->select();
        }else if ($useName==null&&$useCardId){
            $map['community'] = $_SESSION[admin][community];
            $map['useCarId'] = array("LIKE", '%' . $useCardId . '%');
            $res = M('company')->where($map)->select();
        }
        $this->assign("companyInfo",$res);
        $this->display();
    }
}