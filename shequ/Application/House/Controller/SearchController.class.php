<?php
namespace House\Controller;
use Think\Controller;
class SearchController extends CommonController {
    public function index(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        if($name&&$cardId==null){
            $map['community'] = $_SESSION[admin][community];
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('house')->where($map)->select();
        }else if ($name==null&&$cardId){
            $map['community'] = $_SESSION[admin][community];
            $map['cardId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('house')->where($map)->select();
        }
        $this->assign("houseInfo",$res);
        $this->display();
    }

}