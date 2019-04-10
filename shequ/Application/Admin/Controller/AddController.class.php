<?php
namespace Admin\Controller;
use Think\Controller;
class AddController extends CommonController {
    public function index(){
        $community = M('community')->select();

        $this->assign('community',$community);
        $this->display();
    }

    public function add(){
        $res = D('admin')->insertAdmin($_POST);
        if($res){
            return show(1,'添加成功');
        }else{
            return show(0,'添加失败');
        }
    }

    public function community(){
        if($_POST['community'] == null){
            return show(0,'小区名字不能为空');
        }
        $res = M('community')->add($_POST);
        if($res){
            return show(1,"添加成功");
        }else{
            return show(0,'添加失败');
        }
    }


}