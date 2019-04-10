<?php
namespace Task\Controller;
use Think\Controller;
class OperateController extends CommonController {
    public function index(){
        $this->display();
    }

    //领取事件
    public function receive(){
        $id = $_POST['id'];
        $data['isComplete'] = 2;
        $maps['id'] = $id;
        $res = M('task')->where($maps)->save($data);
        if ($res){
            return show(1,"领取成功");
        }else{
            return show(0,"领取失败");
        }
    }

    //处理事件
    public function completing(){
        $id = $_POST['id'];
        $maps1['id'] = $id;
        $maps['eventResult'] = $_POST['eventResult'];
        $maps['isComplete'] = 3;
        $res = M('task')->where($maps1)->save($maps);
        if($res){
            return show(1,'处理成功');
        }else{
            return show(0,'处理失败');
        }
    }

    //审核事件
    public function verify(){
        $id = $_POST['id'];
        $maps1['id'] = $id;
        $maps['isComplete'] = 4;
        $maps['endTime'] = $_POST['endTime'];
        $res = M('task')->where($maps1)->save($maps);
        if($res){
            return show(1,'审核成功');
        }else{
            return show(0,'处理失败');
        }
    }
}