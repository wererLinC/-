<?php
namespace House\Controller;
use Think\Controller;
class EditController extends CommonController {
    public function index(){
        $community = M('community')->select();  //获取小区名称在前端用于选择
        $id = $_GET['id'];
        $res = D('house')->houseById($id);
        $this->assign('community',$community);
        $this->assign('houseInfo',$res);
        $this->display();
    }

    public function edit(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = D('house')->editHouseById($id,$data);
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