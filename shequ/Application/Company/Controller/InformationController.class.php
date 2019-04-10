<?php
namespace Company\Controller;
use Think\Controller;
class InformationController extends CommonController {

    public function index(){
        $id = $_GET['id'];
        $companyInfo = D('company')->getCompanyById($id);
        //通过地址，楼栋，单元，室号查找房屋信息
        $community = $companyInfo['community'];
        $buildNum = $companyInfo['buildnum'];
        $unitNum = $companyInfo['unitnum'];
        $roomNum = $companyInfo['roomnum'];

        $maps['community'] = $community;
        $maps['buildNum'] = $buildNum;
        $maps['unitNum'] = $unitNum;
        $maps['roomNum'] = $roomNum;
        $houseInfo = M('house')->where($maps)->find();

        $this->assign('houseInfo',$houseInfo);
        $this->assign('companyInfo',$companyInfo);
        $this->display();
    }
}