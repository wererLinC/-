<?php
namespace Admin\Controller;
use Think\Controller;
class InformationController extends CommonController {

    public function index(){
        $id = $_GET['id'];
        $res = D('admin')->adminById($id);
        $this->assign('adminInfo',$res);
        $this->display();
    }
}