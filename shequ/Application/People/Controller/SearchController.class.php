<?php
namespace People\Controller;
use Think\Controller;
class SearchController extends CommonController {

    /*
     * 常住
     * */
    public function index(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        if($name&&$cardId==null){
            $maps['community'] = $_SESSION[admin][community];
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('people')->where($map)->select();
        }else if ($name==null&&$cardId){
            $maps['community'] = $_SESSION[admin][community];
            $map['cardId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('people')->where($map)->select();
        }
        $this->assign("peopleInfo",$res);
        $this->display();
    }

    /*
    * 户籍
    * */
    public function qiaolian(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        if($name&&$cardId==null){
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('qiaolian')->where($map)->select();
        }else if ($name==null&&$cardId){
            $map['cardId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('qiaolian')->where($map)->select();
        }
        $this->assign("peopleInfo",$res);
        $this->display();
    }

    /*
    * 暂住
    * */
    public function zanzhu(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        if($name&&$cardId==null){
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('zanzhu')->where($map)->select();
        }else if ($name==null&&$cardId){
            $map['cardId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('zanzhu')->where($map)->select();
        }
        $this->assign("peopleInfo",$res);
        $this->display();
    }

    /*
    * 未驻入
    * */
    public function weizhuru(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        $type = $_GET['type'];
        if($name&&$cardId==null){
            $maps['type'] = $type;
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('people')->where($map)->select();
        }else if ($name==null&&$cardId){
            $maps['type'] = $type;
            $map['cardId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('people')->where($map)->select();
        }
        $this->assign("peopleInfo",$res);
        $this->display();
    }

    /*
     * 迁出
     * */
    public function qianchu(){
        $name = $_GET['name'];
        $cardId = $_GET['cardId'];
        if($name&&$cardId==null){
            $maps['community'] = $_SESSION[admin][community];
            $maps['isDel'] = 1;
            $map['name'] = array("LIKE", '%' . $name . '%');
            $res = M('people')->where($map)->select();
        }else if ($name==null&&$cardId){
            $maps['community'] = $_SESSION[admin][community];
            $maps['isDel'] = 1;
            $map['cardId'] = array("LIKE", '%' . $cardId . '%');
            $res = M('people')->where($map)->select();
        }
        $this->assign("peopleInfo",$res);
        $this->display();
    }
}