<?php
/**
 * Created by PhpStorm.
 * User: 伟林 陈
 * Date: 2018/5/10
 * Time: 23:37
 */

namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
    private $_db = '';
    public function __construct(){
        $this->_db = M('admin');
    }

/*
 * 管理员信息的插入
 */
    public function insertAdmin($data=array()){

        if(!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }


    /*
    *管理员列表加分页
    */
    public function adminList($offset,$pageSize){
        return $this->_db
            ->limit($offset,$pageSize)
            ->select();
    }

/*
*通过id查找管理员
*/
    public function adminById($id){
        return $this->_db
            ->where('id="'.$id.'"')
            ->find();
    }

    //修改管理员信息
    public function editAdminById($id,$data){

        if(!$data || !is_array($data)){
            throw_exception("数据不合法");
        }
        return $this->_db->where('id='.$id)->save($data);
    }

    //通过id删除管理员信息
    public function delAdminById($id){
        return $this->_db->where('id='.$id)->delete();
    }

}