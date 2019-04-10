<?php
namespace Lease\Controller;
use Think\Controller;
class InformationController extends CommonController {

    public function index(){
        $id = $_GET['id'];
        $leaseInfo = D('lease')->getLeaseById($id);
        //通过地址，楼栋，单元，室号查找房屋信息
        $community = $leaseInfo['community'];
        $buildNum = $leaseInfo['buildnum'];
        $unitNum = $leaseInfo['unitnum'];
        $roomNum = $leaseInfo['roomnum'];

        $maps['community'] = $community;
        $maps['buildNum'] = $buildNum;
        $maps['unitNum'] = $unitNum;
        $maps['roomNum'] = $roomNum;
        $houseInfo = M('house')->where($maps)->find();
        //传值到前端
        $this->assign('leaseInfo',$leaseInfo);
        $this->assign('houseInfo',$houseInfo);
        $this->display();
    }
}