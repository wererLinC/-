<?php
namespace Task\Controller;
use Think\Controller;
class ListController extends CommonController {

    //未读任务
    public function index(){
        $fuzeren = $_SESSION[admin][name];
        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3; //一页展示的数目
        $offset = ($page - 1) * $pageSize;


        //查找未读数量
        $maps1['isComplete'] = 1;
        $maps1['fuzeren'] = $fuzeren;
        $indexCount = M('task')->where($maps1)->count();
        //待处理任务数量
        $maps2['isComplete'] = 2;
        $maps2['fuzeren'] = $fuzeren;
        $completingCount = M('task')->where($maps2)->count();
        //待审核任务数量
        $maps3['isComplete'] = 3;
        $verifyCount = M('task')->where($maps3)->count();
        //完成数量
        //判断是否是书记还是社区干部，社区干部得到自己部分，书记得到所有
        if($_SESSION[admin][isadmin] != 1){
            $maps4['isComplete'] = 4;
            $maps4['fuzeren'] = $fuzeren;
        }else{
            $maps4['isComplete'] = 4;
        }
        $completedCount = M('task')->where($maps4)->count();
        //登记任务数量
        $maps5['register'] = $fuzeren;
        $registerCount = M('task')->where($maps5)->count();



        $taskInfo = M('task')->where($maps1)->limit($offset,$pageSize)
            ->select();
        $res = getpage($indexCount, $pageSize);
        $pageRes = $res->show();

        //向前端传送数量过去
        $this->assign('indexCount',$indexCount);
        $this->assign('completingCount',$completingCount);
        $this->assign('verifyCount',$verifyCount);
        $this->assign('completedCount',$completedCount);
        $this->assign('registerCount',$registerCount);

        $this->assign('pageRes', $pageRes);
        $this->assign('taskInfo',$taskInfo);
        $this->display();
    }

    //待处理
    public function completing(){
        $fuzeren = $_SESSION[admin][name];

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3; //一页展示的数目
        $offset = ($page - 1) * $pageSize;

        //查找未读数量
        $maps1['isComplete'] = 1;
        $maps1['fuzeren'] = $fuzeren;
        $indexCount = M('task')->where($maps1)->count();
        //待处理任务数量
        $maps2['isComplete'] = 2;
        $maps2['fuzeren'] = $fuzeren;
        $completingCount = M('task')->where($maps2)->count();
        //待审核任务数量
        $maps3['isComplete'] = 3;
        $verifyCount = M('task')->where($maps3)->count();
        //完成数量
        //判断是否是书记还是社区干部，社区干部得到自己部分，书记得到所有
        if($_SESSION[admin][isadmin] != 1){
            $maps4['isComplete'] = 4;
            $maps4['fuzeren'] = $fuzeren;
        }else{
            $maps4['isComplete'] = 4;
        }
        $completedCount = M('task')->where($maps4)->count();
        //登记任务数量
        $maps5['register'] = $fuzeren;
        $registerCount = M('task')->where($maps5)->count();

            $taskInfo = M('task')->where($maps2)->limit($offset,$pageSize)
                ->select();
        $res = getpage($completingCount, $pageSize);
        $pageRes = $res->show();

        //向前端传送数量过去
        $this->assign('indexCount',$indexCount);
        $this->assign('completingCount',$completingCount);
        $this->assign('verifyCount',$verifyCount);
        $this->assign('completedCount',$completedCount);
        $this->assign('registerCount',$registerCount);

        $this->assign('pageRes', $pageRes);
        $this->assign('taskInfo',$taskInfo);
        $this->display();
    }

    //待审核
    public function verify(){
        $fuzeren = $_SESSION[admin][name];

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3; //一页展示的数目
        $offset = ($page - 1) * $pageSize;

        //查找未读数量
        $maps1['isComplete'] = 1;
        $maps1['fuzeren'] = $fuzeren;
        $indexCount = M('task')->where($maps1)->count();
        //待处理任务数量
        $maps2['isComplete'] = 2;
        $maps2['fuzeren'] = $fuzeren;
        $completingCount = M('task')->where($maps2)->count();
        //待审核任务数量
        $maps3['isComplete'] = 3;
        $verifyCount = M('task')->where($maps3)->count();
        //完成数量
        //判断是否是书记还是社区干部，社区干部得到自己部分，书记得到所有
        if($_SESSION[admin][isadmin] != 1){
            $maps4['isComplete'] = 4;
            $maps4['fuzeren'] = $fuzeren;
        }else{
            $maps4['isComplete'] = 4;
        }
        $completedCount = M('task')->where($maps4)->count();
        //登记任务数量
        $maps5['register'] = $fuzeren;
        $registerCount = M('task')->where($maps5)->count();

            $taskInfo = M('task')->where($maps3)->limit($offset,$pageSize)
                ->select();
            $res = getpage($verifyCount, $pageSize);
            $pageRes = $res->show();

        //向前端传送数量过去
        $this->assign('indexCount',$indexCount);
        $this->assign('completingCount',$completingCount);
        $this->assign('verifyCount',$verifyCount);
        $this->assign('completedCount',$completedCount);
        $this->assign('registerCount',$registerCount);

            $this->assign('pageRes', $pageRes);
            $this->assign('taskInfo',$taskInfo);

        $this->display();
    }

    //已经完成
    public function completed(){
        $fuzeren = $_SESSION[admin][name];

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3; //一页展示的数目
        $offset = ($page - 1) * $pageSize;

        //查找未读数量
        $maps1['isComplete'] = 1;
        $maps1['fuzeren'] = $fuzeren;
        $indexCount = M('task')->where($maps1)->count();
        //待处理任务数量
        $maps2['isComplete'] = 2;
        $maps2['fuzeren'] = $fuzeren;
        $completingCount = M('task')->where($maps2)->count();
        //待审核任务数量
        $maps3['isComplete'] = 3;
        $verifyCount = M('task')->where($maps3)->count();
        //完成数量
        //判断是否是书记还是社区干部，社区干部得到自己部分，书记得到所有
        if($_SESSION[admin][isadmin] != 1){
            $map4['isComplete'] = 4;
            $maps4['fuzeren'] = $fuzeren;
        }else{
            $maps4['isComplete'] = 4;
        }
        $completedCount = M('task')->where($maps4)->count();
        //登记任务数量
        $maps5['register'] = $fuzeren;
        $registerCount = M('task')->where($maps5)->count();

        $taskInfo = M('task')->where($maps4)->limit($offset,$pageSize)
                ->select();

        $res = getpage($completedCount, $pageSize);
        $pageRes = $res->show();

        //向前端传送数量过去
        $this->assign('indexCount',$indexCount);
        $this->assign('completingCount',$completingCount);
        $this->assign('verifyCount',$verifyCount);
        $this->assign('completedCount',$completedCount);
        $this->assign('registerCount',$registerCount);

        $this->assign('pageRes', $pageRes);
        $this->assign('taskInfo',$taskInfo);
        $this->display();
    }

    //登记列表，只有登记的人才能得到
    public function register(){
        $fuzeren = $_SESSION[admin][name];

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //查找未读数量
        $maps1['isComplete'] = 1;
        $maps1['fuzeren'] = $fuzeren;
        $indexCount = M('task')->where($maps1)->count();
        //待处理任务数量
        $maps2['isComplete'] = 2;
        $maps2['fuzeren'] = $fuzeren;
        $completingCount = M('task')->where($maps2)->count();
        //待审核任务数量
        $maps3['isComplete'] = 3;
        $verifyCount = M('task')->where($maps3)->count();
        //完成数量
        //判断是否是书记还是社区干部，社区干部得到自己部分，书记得到所有
        if($_SESSION[admin][isadmin] != 1){
            $maps4['isComplete'] = 4;
            $maps4['fuzeren'] = $fuzeren;
        }else{
            $maps4['isComplete'] = 4;
        }
        $completedCount = M('task')->where($maps4)->count();
        //登记任务数量
        $maps5['register'] = $fuzeren;
        $registerCount = M('task')->where($maps5)->count();

        $taskInfo = M('task')->where($maps5)->limit($offset,$pageSize)
            ->select();
        $res = getpage($registerCount, $pageSize);
        $pageRes = $res->show();

        //向前端传送数量过去
        $this->assign('indexCount',$indexCount);
        $this->assign('completingCount',$completingCount);
        $this->assign('verifyCount',$verifyCount);
        $this->assign('completedCount',$completedCount);
        $this->assign('registerCount',$registerCount);

        $this->assign('pageRes', $pageRes);
        $this->assign('taskInfo',$taskInfo);
        $this->display();
    }
}