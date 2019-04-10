<?php
namespace Admin\Controller;
use Think\Controller;
class SearchController extends CommonController {
    public function index(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        if($name&&$cardId==null){
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('admin')->where($map)->select();
        }else if ($name==null&&$cardId){
            $map['cardId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('admin')->where($map)->select();
        }
        $this->assign("adminInfo",$res);
        $this->display();
    }

    //查找图片
    public function img(){
        $name = $_GET['imgName'];
        $maps['community'] = $_SESSION[admin][community];
        $map['imgName'] = array("LIKE", '%' . $name . '%');
        $res = M('image')->where($map)->select();
        $this->assign("imgInfo",$res);
        $this->display();
    }

    //查找图片
    public function file(){
        $name = $_GET['fileName'];
        $maps['community'] = $_SESSION[admin][community];
        $map['imgName'] = array("LIKE", '%' . $name . '%');
        $res = M('file')->where($map)->select();
        $this->assign("fileInfo",$res);
        $this->display();
    }
}