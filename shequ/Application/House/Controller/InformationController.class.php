<?php
namespace House\Controller;
use Think\Controller;
class InformationController extends CommonController {

    public function index(){
        $id = $_GET['id'];
        $res = D('house')->houseById($id);
        $this->assign('houseInfo',$res);
        $this->display();
    }
}