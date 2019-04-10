<?php
namespace Task\Controller;
use Think\Controller;
class AddController extends CommonController {
    //填写信息
    public function index(){
        $community = $_SESSION[admin][community];
        $maps[community] = $community;
        $fuzeren = M('admin')->where($maps)->select();
        $this->assign('fuzeren',$fuzeren);
        $this->display();
    }

    //获取当事人信息
    public function getInfo(){
        $cardId = $_POST['cardId'];
        $maps['cardId'] = $cardId;
        $res = M('people')->where($maps)->select();
        if (!$res){
            return show(0,"没有相关信息",$res);
        }
        $address = M('house')->where($maps)->getField('address');
        $res['address'] = $address;
        if ($res){
            return show(1,"当事人相关信息",$res);
        }else{
            return show(0,'没有相关信息');
        }
    }

    //增加事件
    public function add(){
        $register = $_SESSION[admin][name];
        $maps1['isAdmin'] = 1;
        $admin = M('admin')->where($maps1)->getField('name');
        $data = $_POST;
        $data['register'] = $register;
        $data['admin'] = $admin;
        $data['isComplete'] = 1;
        $data['community'] = $_SESSION[admin][community];

        $res = M('task')->add($data);
        if ($res){
            if($_SESSION[admin][isadmin != 1]){
                return show(1,"添加成功");
            }else{
                return show(2,'添加成功');
            }

        }else{
            return show(0,'添加失败');
        }

    }

}