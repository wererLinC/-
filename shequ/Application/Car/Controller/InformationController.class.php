<?php
namespace Car\Controller;
use Think\Controller;
class InformationController extends CommonController {

    public function index(){
        //通过id查看车辆信息
        $id = $_GET['id'];
        $carInfo = D('car')->getCarById($id);
        //通过cardId查找房屋信息
        $cardId = $carInfo['cardid'];
        $maps['cardId'] = $cardId;
        $houseInfo = M('house')->where($maps)->select();
        $houseCount = M('house')->where($maps)->count();
        //传值到前端
        $this->assign('houseCount',$houseCount);
        $this->assign('carInfo',$carInfo);
        $this->assign('houseInfo',$houseInfo);
        $this->display();
    }
}