<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller
{
    public function index()
    {
        $this->display();
    }

    //登录验证
    public function check()
    {

        $name = $_POST['name'];
        $cardId = $_POST['cardId'];
        if (!$name) {
            return show(0, '姓名不能为空');
        }
        if (!$cardId) {
            return show(0, "身份证号码不能为空");
        }
        $res = M('admin')->where('name="'.$name.'"')->find();

        if (!$res) {
            return show(0, '没有该用户');
        }
        if ($res['cardid'] != $cardId) {
            return show(0, '身份证号码错误');
        }
        session('admin', $res);

        return show(1, '登录成功');

    }

    public function logout()
    {
        session('admin', null);
        $this->success('正在登出', '/index.php?m=home&c=login&a=index', 3);

    }
}