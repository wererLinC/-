<?php
namespace Charge\Controller;
use Think\Controller;
class DelController extends CommonController {
    public function index(){
        $this->display();
    }

    public function del(){
        $id = $_POST['id'];
        $res = D('charge')->delChargeById($id);
        if($res){
            return show(1,"success");
        }else{
            return show(0,"failed");
        }
    }
}