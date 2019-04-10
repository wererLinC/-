<?php
namespace People\Controller;
use Think\Controller;
class InformationController extends CommonController {

    public function index(){

        $id = $_GET['id'];
        $res = D('people')->getPeopleInfoById($id);
        $this->assign('peopleInfo',$res);
        $this->display();
    }

    public function zanzhu(){

        $id = $_GET['id'];
        $map['id'] = $id;
        $res = M('zanzhu')->where($map)->find();
        //通过地址，楼栋，单元，室号查找房屋信息
        $community = $res['community'];
        $buildNum = $res['buildnum'];
        $unitNum = $res['unitnum'];
        $roomNum = $res['roomnum'];

        $maps['community'] = $community;
        $maps['buildNum'] = $buildNum;
        $maps['unitNum'] = $unitNum;
        $maps['roomNum'] = $roomNum;
        $houseInfo = M('house')->where($maps)->find();

        $this->assign('peopleInfo',$res);
        $this->assign('houseInfo',$houseInfo);
        $this->display();
    }
}