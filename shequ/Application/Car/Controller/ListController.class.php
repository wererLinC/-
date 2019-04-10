<?php
namespace Car\Controller;
use Think\Controller;
class ListController extends CommonController {
    public function index(){

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 9; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //查找数量
        $maps['community'] = $_SESSION[admin][community];
        $count = M('car')->where($maps)->count();
        //从messasge表中查找所有的信息
        $carInfo = M('car')->where($maps)->limit($offset,$pageSize)
            ->select();
        $res = getpage($count, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign('count', $count);
        $this->assign('pageRes', $pageRes);
        $this->assign('carInfo',$carInfo);
        $this->display();
    }

}