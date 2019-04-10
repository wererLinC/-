<?php
namespace People\Controller;
use Think\Controller;
class DelController extends CommonController {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    /*
     * 迁出用户
     */
    //迁出长住户和户籍户
    public function del(){
       $id = $_POST['id'];
        $maps['id'] = $id;
        $data['isDel'] = 1;
        $res = M('people')->where($maps)->save($data);
       if($res){
           return show(1,"success");
       }else{
           return show(0,"failed");
       }
    }

    //迁出华侨
    public function qiaolian(){
        $id = $_POST['id'];
        $maps['id'] = $id;
        $data['isDel'] = 1;
        $res = M('qiaolian')->where($maps)->save($data);
        if($res){
            return show(1,"success");
        }else{
            return show(0,"failed");
        }
    }

    //迁出暂住
    public function zanzhu(){
        $id = $_POST['id'];
        $maps['id'] = $id;
        $data['isDel'] = 1;
        $res = M('zanzhu')->where($maps)->save($data);
        if($res){
            return show(1,"success");
        }else{
            return show(0,"failed");
        }
    }


    /*
    * 迁回用户
    */
    //迁回常住和户籍
    public function revoke(){
        $id = $_POST['id'];
        $maps['id'] = $id;
        $data['isDel'] = 0;
        $res = M('people')->where($maps)->save($data);
        if($res){
            return show(1,"success");
        }else{
            return show(0,"failed");
        }
    }




    /*
    * 永久删除用户
    */


    public function everDel(){
        $id = $_POST['id'];
        $maps['id'] = $id;
        $res = M('people')->where($maps)->delete();
        if($res){
            return show(1,"success");
        }else{
            return show(0,"failed");
        }
    }
}