<?php
namespace Task\Controller;
use Think\Controller;
class InformationController extends CommonController {
    public function index(){
        $id = $_GET['id'];
        $maps['id'] = $id;
        $res = M('task')->where($maps)->find();
        $this->assign('taskInfo',$res);
        $this->display();
    }

}