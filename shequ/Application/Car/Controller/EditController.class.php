<?php
namespace Car\Controller;
use Think\Controller;
class EditController extends CommonController {
    public function index(){
        $id = $_GET['id'];
        $carInfo = D('car')->getCarById($id);
        $this->assign('carInfo',$carInfo);
        $this->display();
    }
    public function edit(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = D('car')->editCarById($id,$data);
        try{
            if($res){
                return show(1,"修改成功");
            }else{
                return show(0,"修改失败");
            }
        }catch (Exception $e){
            return show(0,$e->getMessage());
        }
    }
}