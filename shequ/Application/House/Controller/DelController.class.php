<?php
namespace House\Controller;
use Think\Controller;
class DelController extends CommonController {
    public function index(){
        $this->display();
    }

    public function del(){
        $id = $_POST['id'];
        $res = D('house')->delHouseById($id);
        if($res){
            return show(1,'删除成功');
        }else{
            return show(0,'删除失败');
        }
    }
}