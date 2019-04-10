<?php
namespace People\Controller;
use Think\Controller;
class PublicController extends CommonController {
    public function base(){
        //常住人数
        $maps1['type'] = 1;
        $maps1['community'] = $_SESSION[admin][community];
        $peopleCount1 = M('people')->where($maps1)->count();
        //户籍人数
        $maps2['type'] = 2;
        $maps2['community'] = $_SESSION[admin][community];
        $peopleCount2 = M('people')->where($maps2)->count();
        //暂住人数
        $maps3['type'] = 3;
        $maps3['community'] = $_SESSION[admin][community];
        $peopleCount3 = M('people')->where($maps3)->count();
        //未驻入人数
        $maps4['type'] = 4;
        $maps4['community'] = $_SESSION[admin][community];
        $peopleCount4 = M('people')->where($maps4)->count();

        $this->assign("peopleCount1",$peopleCount1);
        $this->assign("peopleCount2",$peopleCount2);
        $this->assign("peopleCount3",$peopleCount3);
        $this->assign("peopleCount4",$peopleCount4);
        $this->display();
    }


}