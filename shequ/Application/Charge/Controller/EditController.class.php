<?php
namespace Charge\Controller;
use Think\Controller;
class EditController extends CommonController {
    public function index(){
        $this->display();
    }
    public function edit(){
        $id = $_POST['id'];
        $money = $_POST['money'];
        $maps['money'] = $money;
        $res = D('charge')->editChargeById($id,$maps);
        if ($res){
            return show(1,"修改成功");
        }else{
            return show(0,"修改失败");
        }
    }


    //重置收费数据
    public function resetData(){
        $content = $_POST['content'];
        $maps['community'] = $_SESSION[admin][community];
        $data['money'] = 0;
        $data['isCharge'] = 0;
        $res = M('charge')->where($maps)->save($data);
        if($res){
            return show(1,$content);
        }else{
            return show(0,'failed');
        }
        $this->display();
    }
}