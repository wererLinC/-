<?php
namespace Charge\Controller;
use Think\Controller;
class AddController extends CommonController {
    public function index(){
    }

    public function add(){
        $id = $_POST['id'];
        $money = $_POST['money'];
        $time = $_POST['time'];
        $admin = $_SESSION['admin']['name'];

        if ($money ==0||$money==null){
            return show(0,"费用不能为 0 !!!");
        }

        $maps['money'] = $money;
        $maps['admin'] = $admin;
        $maps['time'] = $time;
        $res = D('charge')->editChargeById($id,$maps);
        if($res){
            return show(1,"添加成功");
        }else{
            return show(0,"添加失败");
        }

    }

    public function conform(){
        $id = $_POST['id'];
        $maps['isCharge'] = 1;
        $res = D('charge')->editChargeById($id,$maps);
        if($maps){
            return show(1,"success");
        }else{
            return show(0,'failed');
        }

    }
}