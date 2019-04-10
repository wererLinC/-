<?php
namespace Charge\Controller;
use Think\Controller;
class InformationController extends CommonController {

    public function index(){
        $id = $_GET['id'];
        $chargeInfo = D('charge')->chargeById($id);
        //通过地址，楼栋，单元，室号查找房屋信息
        $community = $chargeInfo['community'];
        $buildNum = $chargeInfo['buildnum'];
        $unitNum = $chargeInfo['unitnum'];
        $roomNum = $chargeInfo['roomnum'];

        $maps['community'] = $community;
        $maps['buildNum'] = $buildNum;
        $maps['unitNum'] = $unitNum;
        $maps['roomNum'] = $roomNum;
        $houseInfo = M('house')->where($maps)->find();

        $this->assign('houseInfo',$houseInfo);
        $this->assign('chargeInfo',$chargeInfo);
        $this->display();
    }
}