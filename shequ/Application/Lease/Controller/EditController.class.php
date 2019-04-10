<?php
namespace Lease\Controller;
use Think\Controller;
class EditController extends CommonController {
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

    public function edit(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = D('lease')->editleaseById($id,$data);
        try{
            if($res){
                return show(1,"修改成功");
            }else{
                return show(0,"修改失败");
            }
        }catch (Exception $e){
            return show(0,$e->getMessage());
        }
    }
}