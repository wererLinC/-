<?php
namespace People\Controller;
use Think\Controller;
class AddController extends CommonController {
    /*
     * 添加的页面
     */
    //常住人员添加首页
    public function index(){
        $community = M('community')->select();
        $this->assign('community',$community);
        $id = $_GET['id'];
        $maps['id'] = $id;
        $ownerName = M('people')->where($maps)->getField('ownerName');
        $this->assign('ownerName',$ownerName);
        $this->display();
    }
    //户籍人员添加首页
    public function huji(){
        $community = M('community')->select();
        $this->assign('community',$community);
        $id = $_GET['id'];
        $maps['id'] = $id;
        $ownerName = M('people')->where($maps)->getField('ownerName');
        $this->assign('ownerName',$ownerName);
        $this->display();
    }

    //暂住人员添加首页
    public function zanzhu(){
        $id = $_GET['id'];
        $maps['id'] = $id;
        $ownerName = M('people')->where($maps)->getField('ownerName');
        $this->assign('ownerName',$ownerName);
        $this->display();
    }
    //侨联人员添加首页
    public function qiaolian(){
        $id = $_GET['id'];
        $maps['id'] = $id;
        $ownerName = M('people')->where($maps)->getField('ownerName');
        $this->assign('ownerName',$ownerName);
        $this->display();
    }


    /*
     * 添加的方法
     */
    //添加常住，户籍人员信息
    public function add(){
	$data = $_POST;
	$data['isDel'] = 0;
        $result = D('people')->insertPeople($data);
        if ($result){
            return show(1,"添加成功,继续添加");
        }else{
            return show(0,"添加失败");
        }
    }

    //添加侨联信息
    public function addQiaoLian(){
	$data = $_POST;
	$data['isDel'] = 0;
        $result = M('qiaolian')->add($data);
        if ($result){
            return show(1,"添加成功");
        }else{
            return show(0,"添加失败");
        }
    }

    //添加暂住人员时获取房屋信息
    public function getInfo(){
        $maps = $_POST;
        $maps['community'] = $_SESSION[admin][community];
        $data = M('house')->where($maps)->find();
        if ($data){
            return show(1,"相关房屋信息",$data);
        }else{
            return show(0,'未找到相关记录');
        }
    }

    //添加暂住人员
    public function addZanZhu(){
	$data = $_POST;
	$data['isDel'] = 0;
        $res = M('zanzhu')->add($data);
        if($res){
            return show(1,'添加成功');
        }else{
            return show(0,'添加失败');
        }
    }


    //照片异步上传,原文件名上传
    public function img(){
        if (!empty($_FILES)) {
            //图片上传设置
            $config = array(
               'maxSize' => 3145728,
                'savePath' => '/img/',
                ''=>'',
                'saveRule' => '',
                'saveName' => '',
                'subName'=>'',
                'exts' => array('jpg', 'gif', 'png', 'jpeg'),            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $images = $upload->upload();
            //判断是否有图
            if ($images) {
                $info = $images['thumb']['savepath'] . $images['thumb']['savename'];
                $data['url'] = $info;
                $data['imgName'] = $images['thumb']['savename'];
                $data['community'] = $_SESSION['admin'][community];
                $res = M('image')->add($data);
                $this->ajaxReturn($info,"json");
                //返回文件地址和名给JS作回调用
            } else {
                $this->error($upload->getError());//获取失败信息
            }
        }
    }
}