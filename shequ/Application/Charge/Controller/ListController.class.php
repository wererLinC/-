<?php
namespace Charge\Controller;
use Think\Controller;
class ListController extends CommonController {
    public function index(){
        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //查找数量
        $maps['money'] = 0;
        $maps['community'] = $_SESSION[admin][community];

        //添加收费的数量
        $count = M('charge')
            ->where($maps)
            ->count();
        //待收费收费的数量
        $unCharge['isCharge'] = 0;
        $unCharge['community'] = $_SESSION[admin][community];
        $unChargeWhere['money'] =array('neq',0);
        $unChargeCount = M('charge')
            ->where($unCharge)
            ->where($unChargeWhere)
            ->count();
        //收完费的数量
        $charged['isCharge'] = 1;
        $charged['community'] = $_SESSION[admin][community];
        $chargedWhere['money'] =array('neq',0);
        $chargedCount = M('charge')
            ->where($charged)
            ->where($chargedWhere)
            ->count();

        //从charge表中查找所有的信息
        $chargeInfo = M('charge')
            ->where($maps)
            ->limit($offset,$pageSize)
            ->select();
        $res = getpage($count, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign('count', $count);
        $this->assign('unChargeCount',$unChargeCount);
        $this->assign('chargedCount',$chargedCount);
        $this->assign('pageRes', $pageRes);
        $this->assign('chargeInfo',$chargeInfo);

        $this->display();
    }

    public function unCharge(){
        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //查找数量
        $maps['isCharge'] = 0;
        $maps['community'] = $_SESSION[admin][community];
        $where['money'] =array('neq',0);
        $count = M('charge')
            ->where($maps)
            ->where($where)
            ->count();

        //未收费
        $index['money'] = 0;
        $index['community'] = $_SESSION[admin][community];
        $indexCount = M('charge')
            ->where($index)
            ->count();
        //待收费的数量
        $unCharge['isCharge'] = 0;
        $unCharge['community'] = $_SESSION[admin][community];
        $unChargeWhere['money'] =array('neq',0);
        $unChargeCount = M('charge')
            ->where($unCharge)
            ->where($unChargeWhere)
            ->count();
        //收完费的数量
        $charged['isCharge'] = 1;
        $charged['community'] = $_SESSION[admin][community];
        $chargedWhere['money'] =array('neq',0);
        $chargedCount = M('charge')
            ->where($charged)
            ->where($chargedWhere)
            ->count();
        //从charge表中查找所有的信息
        $chargeInfo = M('charge')
            ->where($maps)
            ->where($where)
            ->limit($offset,$pageSize)
            ->select();

        $res = getpage($count, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign('count', $count);
        $this->assign('indexCount',$indexCount);
        $this->assign('chargedCount',$chargedCount);
        $this->assign('pageRes', $pageRes);
        $this->assign('chargeInfo',$chargeInfo);

        $this->display();
    }

    public function charged(){
        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5; //一页展示的数目
        $offset = ($page - 1) * $pageSize;
        //查找数量
        $maps['isCharge'] = 1;
        $maps['community'] = $_SESSION[admin][community];
        $where['money'] =array('neq',0);
        $count = M('charge')
            ->where($maps)
            ->where($where)
            ->count();
        //未收费
        $index['money'] = 0;
        $index['community'] = $_SESSION[admin][community];
        $indexCount = M('charge')
            ->where($index)
            ->count();
        //待收费的数量
        $unCharge['isCharge'] = 0;
        $unCharge['community'] = $_SESSION[admin][community];
        $unChargeWhere['money'] =array('neq',0);
        $unChargeCount = M('charge')
            ->where($unCharge)
            ->where($unChargeWhere)
            ->count();
        //从charge表中查找所有的信息
        $chargeInfo = M('charge')
            ->where($maps)
            ->where($where)
            ->limit($offset,$pageSize)
            ->select();

        $res = getpage($count, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign('count', $count);
        $this->assign('unChargeCount',$unChargeCount);
        $this->assign('indexCount',$indexCount);
        $this->assign('pageRes', $pageRes);
        $this->assign('chargeInfo',$chargeInfo);

        $this->display();
    }
}