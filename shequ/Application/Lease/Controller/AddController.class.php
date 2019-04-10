<?php
namespace Lease\Controller;
use Think\Controller;
class AddController extends CommonController {
    public function index(){
        $community = M("community")->select();
        $this->assign("community",$community);
        $this->display();
    }

    //通过社区，楼栋，单元，室号来查找房屋信息
    public function getInfo(){
        //通过cardId获取房屋信息,这里我只要求一个就好
        $maps = $_POST;
        $maps['community'] = $_SESSION[admin][community];
        $res = M('house')->where($maps)->limit(1)->find();
        if ($res){
            return show(1,'房屋相关信息',$res);
        }else{
            return show(0,'没有相关信息');
        }
    }

    public function add(){
        $res = D("lease")->insertLease($_POST);
        if($res){
            return show(1,"添加成功");
        }else{
            return show(0,"添加失败");
        }
    }
}