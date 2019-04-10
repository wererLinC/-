<?php
namespace Admin\Controller;
use Think\Controller;
class DelController extends CommonController {
    public function index(){
        $this->display();
    }

    public function del(){
        $id = $_POST['id'];
        $res = D('admin')->delAdminById($id);
        if($res){
            return show(1,'删除成功');
        }else{
            return show(0,'删除失败');
        }
    }

    public function community(){
        $id = $_POST['id'];
        $maps['id'] = $id;
        $res = M('community')->where($maps)->delete();
        if($res){
            return show(1,"删除成功");
        }else{
            return show(0,"删除失败");
        }
    }
}