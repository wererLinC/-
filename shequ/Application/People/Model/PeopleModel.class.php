<?php
/**
 * Created by PhpStorm.
 * User: 伟林 陈
 * Date: 2018/5/10
 * Time: 23:37
 */

namespace People\Model;
use Think\Model;

class PeopleModel extends Model{
    private $_db = '';
    public function __construct(){
        $this->_db = M('people');
    }

/*
 * 人员信息的插入
 */
    public function insertPeople($data=array()){

        if(!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }
 /*
 *人员列表加分页
 */
    public function peopleList($offset,$pageSize){
        return $this->_db
            ->limit($offset,$pageSize)
            ->select();
    }

    /*
     *通过id查找人员信息
     */
    public function getPeopleInfoById($id){
        return $this->_db
            ->where('id="'.$id.'"')
            ->find();
    }

    /*
     *通过id修改人员信息
     */
    public function editPeopleInfoById($id,$data){
        return $this->_db
            ->where('id="'.$id.'"')
            ->save($data);
    }

    /*
     *通过id删除人员信息
     */
    public function delPeopleInfoById($id,$data){
        return $this->_db
            ->where('id="'.$id.'"')
            ->delete();
    }
}