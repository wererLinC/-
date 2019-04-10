<?php
namespace Task\Controller;
use Think\Controller;
class DelController extends CommonController {
    public function index(){
        $id = $_POST['id'];
        $maps['id'] = $id;
        $res = M('task')->where($maps)->delete();
        if($res){
            return show(1,'删除成功');
        }else{
            return show(0,'删除失败');
        }
    }
}