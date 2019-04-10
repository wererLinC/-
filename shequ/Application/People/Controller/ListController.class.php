<?php
namespace People\Controller;
use Think\Controller;
class ListController extends CommonController {

    //常住列表
    public function index(){
        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 9; //一页展示的数目
        $offset = ($page - 1) * $pageSize;

        //长住户数量
        $maps1['isDel'] = 0;
        $maps1['community'] = $_SESSION[admin][community];
        $maps1['roomType'] = 1;
        $peopleCount1 = M('people')->where($maps1)->count();
        //户籍户数量
        $maps2['isDel'] = 0;
        $maps2['community'] = $_SESSION[admin][community];
        $maps2['roomType'] = 2;
        $peopleCount2 = M('people')->where($maps2)->count();
        //暂住户数量
        $maps3['isDel'] = 0;
        $maps3['community'] = $_SESSION[admin][community];
        $maps3['roomType'] = 3;
        $peopleCount3 = M('zanzhu')->where($maps3)->count();
        //侨联数量
        $maps4['isDel'] = 0;
        $maps4['community'] = $_SESSION[admin][community];
        $peopleCount4 = M('qiaolian')->where($maps4)->count();
        //迁出数量
        $maps5['isDel'] = 1;
        $maps5['community'] = $_SESSION[admin][community];
        $peopleCount5 = M('people')->where($maps5)->count()+M('qiaolian')->where($maps5)->count()+M('zanzhu')->where($maps5)->count();

        //从messasge表中查找所有的信息
        $peopleInfo = M('people')->where($maps1)->limit($offset,$pageSize)->select();
        $res = getpage($peopleCount1, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign("peopleCount1",$peopleCount1);
        $this->assign("peopleCount2",$peopleCount2);
        $this->assign("peopleCount3",$peopleCount3);
        $this->assign("peopleCount4",$peopleCount4);
        $this->assign("peopleCount5",$peopleCount5);

        $this->assign('pageRes', $pageRes);
        $this->assign('peopleInfos',$peopleInfo);

        $this->display();
    }

        /*户籍列表*/
    public function huji(){

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 9; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //长住户数量
        $maps1['isDel'] = 0;
        $maps1['community'] = $_SESSION[admin][community];
        $maps1['roomType'] = 1;
        $peopleCount1 = M('people')->where($maps1)->count();
        //户籍户数量
        $maps2['isDel'] = 0;
        $maps2['community'] = $_SESSION[admin][community];
        $maps2['roomType'] = 2;
        $peopleCount2 = M('people')->where($maps2)->count();
        //暂住户数量
        $maps3['isDel'] = 0;
        $maps3['community'] = $_SESSION[admin][community];
        $maps3['roomType'] = 3;
        $peopleCount3 = M('zanzhu')->where($maps3)->count();
        //侨联数量
        $maps4['isDel'] = 0;
        $maps4['community'] = $_SESSION[admin][community];
        $peopleCount4 = M('qiaolian')->where($maps4)->count();
        //迁出数量
        $maps5['isDel'] = 1;
        $maps5['community'] = $_SESSION[admin][community];
        $peopleCount5 = M('people')->where($maps5)->count()+M('qiaolian')->where($maps5)->count()+M('zanzhu')->where($maps5)->count();
        //从messasge表中查找所有的信息
        $peopleInfo = M('people')->where($maps2)->limit($offset,$pageSize)->select();
        $res = getpage($peopleCount2, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign("peopleCount1",$peopleCount1);
        $this->assign("peopleCount2",$peopleCount2);
        $this->assign("peopleCount3",$peopleCount3);
        $this->assign("peopleCount4",$peopleCount4);
        $this->assign("peopleCount5",$peopleCount5);

        $this->assign('pageRes', $pageRes);
        $this->assign('peopleInfo',$peopleInfo);

        $this->display();
    }

    /*暂住列表*/
    public function zanzhu(){

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 9; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //长住户数量
        $maps1['isDel'] = 0;
        $maps1['community'] = $_SESSION[admin][community];
        $maps1['roomType'] = 1;
        $peopleCount1 = M('people')->where($maps1)->count();
        //户籍户数量
        $maps2['isDel'] = 0;
        $maps2['community'] = $_SESSION[admin][community];
        $maps2['roomType'] = 2;
        $peopleCount2 = M('people')->where($maps2)->count();
        //暂住户数量
        $maps3['isDel'] = 0;
        $maps3['community'] = $_SESSION[admin][community];
        $maps3['roomType'] = 3;
        $peopleCount3 = M('zanzhu')->where($maps3)->count();
        //侨联数量
        $maps4['isDel'] = 0;
        $maps4['community'] = $_SESSION[admin][community];
        $peopleCount4 = M('qiaolian')->where($maps4)->count();
        //迁出数量
        $maps5['isDel'] = 1;
        $maps5['community'] = $_SESSION[admin][community];
        $peopleCount5 = M('people')->where($maps5)->count()+M('qiaolian')->where($maps5)->count()+M('zanzhu')->where($maps5)->count();
        //从messasge表中查找所有的信息
        $peopleInfo = M('zanzhu')->where($maps3)->limit($offset,$pageSize)->select();
        $res = getpage($peopleCount3, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign("peopleCount1",$peopleCount1);
        $this->assign("peopleCount2",$peopleCount2);
        $this->assign("peopleCount3",$peopleCount3);
        $this->assign("peopleCount4",$peopleCount4);
        $this->assign("peopleCount5",$peopleCount5);

        $this->assign('pageRes', $pageRes);
        $this->assign('peopleInfo',$peopleInfo);

        $this->display();
    }

    /*为注入列表*/
    public function weizhuru(){

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 9; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //查找数量
        $maps['isDel'] = 0;
        $maps['community'] = $_SESSION[admin][community];
        $maps['roomType'] = 4;
        $count = M('people')->where($maps)->count();
        //从messasge表中查找所有的信息
        $peopleInfo = M('people')->where($maps)->limit($offset,$pageSize)->select();
        $res = getpage($count, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign('pageRes', $pageRes);
        $this->assign('peopleInfo',$peopleInfo);

        $this->display();
    }

    /*桥联列表*/
    public function qiaolian(){

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 9; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //长住户数量
        $maps1['isDel'] = 0;
        $maps1['community'] = $_SESSION[admin][community];
        $maps1['roomType'] = 1;
        $peopleCount1 = M('people')->where($maps1)->count();
        //户籍户数量
        $maps2['isDel'] = 0;
        $maps2['community'] = $_SESSION[admin][community];
        $maps2['roomType'] = 2;
        $peopleCount2 = M('people')->where($maps2)->count();
        //暂住户数量
        $maps3['isDel'] = 0;
        $maps3['community'] = $_SESSION[admin][community];
        $maps3['roomType'] = 3;
        $peopleCount3 = M('zanzhu')->where($maps3)->count();
        //侨联数量
        $maps4['isDel'] = 0;
        $maps4['community'] = $_SESSION[admin][community];
        $peopleCount4 = M('qiaolian')->where($maps4)->count();
        //迁出数量
        $maps5['isDel'] = 1;
        $maps5['community'] = $_SESSION[admin][community];
        $peopleCount5 = M('people')->where($maps5)->count()+M('qiaolian')->where($maps5)->count()+M('zanzhu')->where($maps5)->count();
        //从messasge表中查找所有的信息
        $peopleInfo = M('qiaolian')->where($maps4)->limit($offset,$pageSize)->select();
        $res = getpage($peopleCount4, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign("peopleCount1",$peopleCount1);
        $this->assign("peopleCount2",$peopleCount2);
        $this->assign("peopleCount3",$peopleCount3);
        $this->assign("peopleCount4",$peopleCount4);
        $this->assign("peopleCount5",$peopleCount5);

        $this->assign('pageRes', $pageRes);
        $this->assign('peopleInfos',$peopleInfo);

        $this->display();
    }

    /*迁出列表*/
    public function qianchu(){

        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 9; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //长住户数量
        $maps1['isDel'] = 0;
        $maps1['community'] = $_SESSION[admin][community];
        $maps1['roomType'] = 1;
        $peopleCount1 = M('people')->where($maps1)->count();
        //户籍户数量
        $maps2['isDel'] = 0;
        $maps2['community'] = $_SESSION[admin][community];
        $maps2['roomType'] = 2;
        $peopleCount2 = M('people')->where($maps2)->count();
        //暂住户数量
        $maps3['isDel'] = 0;
        $maps3['community'] = $_SESSION[admin][community];
        $maps3['roomType'] = 3;
        $peopleCount3 = M('zanzhu')->where($maps3)->count();
        //侨联数量
        $maps4['isDel'] = 0;
        $maps4['community'] = $_SESSION[admin][community];
        $peopleCount4 = M('qiaolian')->where($maps4)->count();
        //迁出数量
        $maps5['isDel'] = 1;
        $maps5['community'] = $_SESSION[admin][community];
        $peopleCount5 = M('people')->where($maps5)->count();
        //从messasge表中查找所有的信息
        $peopleInfo = M('people')->where($maps5)->limit($offset,$pageSize)->select();
        $res = getpage($peopleCount5, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign("peopleCount1",$peopleCount1);
        $this->assign("peopleCount2",$peopleCount2);
        $this->assign("peopleCount3",$peopleCount3);
        $this->assign("peopleCount4",$peopleCount4);
        $this->assign("peopleCount5",$peopleCount5);

        $this->assign('pageRes', $pageRes);
        $this->assign('peopleInfo',$peopleInfo);

        $this->display();
    }
}