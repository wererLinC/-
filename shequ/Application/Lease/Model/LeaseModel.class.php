<?php
/**
 * Created by PhpStorm.
 * User: 伟林 陈
 * Date: 2018/5/10
 * Time: 23:37
 */

namespace Lease\Model;
use Think\Model;

class LeaseModel extends Model{
    private $_db = '';
    public function __construct(){
        $this->_db = M('lease');
    }

/*
 * 出租信息的插入
 */
    public function insertLease($data=array()){

        if(!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }


    /*
    *出租列表加分页
    */
    public function leaseList($offset,$pageSize){
        return $this->_db
            ->limit($offset,$pageSize)
            ->select();
    }

/*
*通过id查找出租
*/
    public function getLeaseById($id){
        return $this->_db
            ->where('id="'.$id.'"')
            ->find();
    }

    //修改出租信息
    public function editLeaseById($id,$data){

        if(!$data || !is_array($data)){
            throw_exception("数据不合法");
        }
        return $this->_db->where('id='.$id)->save($data);
    }

    //通过id删除出租信息
    public function delLeaseById($id){
        return $this->_db->where('id='.$id)->delete();
    }

}