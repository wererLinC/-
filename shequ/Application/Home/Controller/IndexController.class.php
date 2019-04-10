<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    //所有管理员的首页
    public function index(){
        //房屋个数
        $fileInfo = M('file')->limit(6)->select();
        $fileCount = M('file')->count();
        $map['community'] = $_SESSION[admin][community];
        $houseCount = M('house')->where($map)->count();
        $peopleCount = M('people')->where($map)->count()+M('qiaolian')->where($map)->count();
        $carCount = M('car')->where($map)->count();
        $leaseCount = M('lease')->where($map)->count();
        $adminCount = M('admin')->count();
        $chargeCount = M('charge')->where($map)->count();
        $companyCount = M('company')->where($map)->count();
        $community = M('community')->select();
        $communityCount = M('community')->count();
        if($_SESSION[admin][isadmin] != 1){
            $maps['fuzeren'] = $_SESSION[admin][name];
            $maps['isComplete'] = 1;
            $unTaskCount = M('task')->where($maps)->count();
        }else{
            $maps['isComplete'] = 3;
            $maps['admin'] = $_SESSION[admin][name];
            $unTaskCount = M('task')->where($maps)->count();
        }

        if($_SESSION[admin][isadmin] != 1){
            $taskMap['fuzeren'] = $_SESSION[admin][name];
            $taskCount = M('task')->where($taskMap)->count();
        }else{
            $taskMap['admin'] = $_SESSION[admin][name];
            $taskCount = M('task')->where($taskMap)->count();
        }


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

        $this->assign("chargeCount",$chargeCount);
        $this->assign("taskCount",$taskCount);
        $this->assign("unTaskCount",$unTaskCount);
        $this->assign("companyCount",$companyCount);
        $this->assign("adminCount",$adminCount);
        $this->assign("leaseCount",$leaseCount);
        $this->assign("carCount",$carCount);
        $this->assign("houseCount",$houseCount);
        $this->assign("peopleCount",$peopleCount);
        $this->assign("communityCount",$communityCount);
        $this->assign("community",$community);
        $this->assign("communitys",$community);
        $this->assign("communityShow",$community);
        $this->assign("fileInfo",$fileInfo);
        $this->assign("fileCount",$fileCount);
        $this->display();
    }


    //看是否有未读的任务,如果有则提示责任人
    public function task(){
        if($_POST['isAdmin'] != 1){
            $map['isComplete'] = 2;
            $map['fuzeren'] = $_SESSION[admin][name];
            $res = M('task')->where($map)->count();
            if($res > 0){
                return show(2,"您还有未处理任务，是否前往");
            }
            $maps['isComplete'] = 1;
            $maps['fuzeren'] = $_SESSION[admin][name];
            $ress = M('task')->where($maps)->count();
            if($ress > 0){
                return show(1,"您还有未读任务，是否前往");
            }

        }else{
            $maps['isComplete'] = 3;
            $maps['admin'] = $_SESSION[admin][name];
            $res = M('task')->where($maps)->count();
            if($res > 0){
                return show(3,"您还有未审核的任务，是否前往");
            }
        }
    }
    //书记特有的首页、，也就是isadmin特有的首页
    //TODO
    public function exCommunity(){
        $id = $_POST['id'];
        $_SESSION[admin][community] = $id;

        if($_SESSION[admin][community] == $id){
            return show(1,"切换成功");
        }else{
            return show(0,"failed");
        }
    }

	public function note(){
		$this->display();

	}

}