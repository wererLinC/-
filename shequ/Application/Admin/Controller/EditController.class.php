<?php
namespace Admin\Controller;
use Think\Controller;
class EditController extends CommonController {
    public function index(){
        $id = $_GET['id'];
        $res = D('admin')->adminById($id);
        $this->assign('adminInfo',$res);
        $this->display();
    }

    public function edit(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = D('admin')->editAdminById($id,$data);
        try{
            if($res){
                session('admin', null);
                return show(1,"修改成功");
            }else{
                return show(0,"修改失败");
            }
        }catch (Exception $e){
            return show(0,$e->getMessage());
        }
    }

    public function wanshan(){
        $id = $_GET['id'];

        $this->assign('id',$id);
        $this->display();
    }

    public function wanshan1(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = D('admin')->editAdminById($id,$data);
        if($res){
            session('admin', null);
            return show(1,'完善成功,请重新登录');
        }else{
            return show(0,"完善失败");
        }
    }
}