<?php
namespace House\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
//判断用户是否已经登录
        if (!isset($_SESSION['admin'])) {
            $this->error('对不起,您还没有登录','/index.php?m=home&c=login&a=index', 3);
        }
    }
}