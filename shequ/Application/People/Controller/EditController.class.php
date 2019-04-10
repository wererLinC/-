<?php
namespace People\Controller;
use Think\Controller;
class EditController extends CommonController {
    /*
     * 修改页面
     */
    //常住和户籍
    public function index(){
        $id = $_GET['id'];
        $res = D('people')->getPeopleInfoById($id);
        $this->assign('peopleInfo',$res);
        $this->display();
    }

    //侨联
    public function qiaolian(){
        $id = $_GET['id'];
        $res = M('qiaolian')->where('id="'.$id.'"')->find();
        $this->assign('peopleInfo',$res);
        $this->display();
    }

    //暂住
    public function zanzhu(){
        $id = $_GET['id'];
        $res = M('zanzhu')->where('id="'.$id.'"')->find();
        $this->assign('peopleInfo',$res);
        $this->display();
    }

    /*
    * 修改方法
    */

    //修改常住和户籍
    public function edit(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = D('people')->editPeopleInfoById($id,$data);
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

    //修改侨联
    public function editQiaoLian(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = M('qiaolian')->where('id="'.$id.'"')->save($data);
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

    //修改暂住
    public function editZanZhu(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = M('zanzhu')->where('id="'.$id.'"')->save($data);
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