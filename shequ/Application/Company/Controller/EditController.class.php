<?php
namespace Company\Controller;
use Think\Controller;
class EditController extends CommonController {
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

    public function edit(){
        $id=$_POST['id'];
        unset($_POST['id']);
        $data = $_POST;
        $res = D('company')->editCompanyById($id,$data);
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