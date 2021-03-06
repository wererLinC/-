<?php
/**
 * Created by PhpStorm.
 * User: 伟林 陈
 * Date: 2018/5/10
 * Time: 23:37
 */

namespace Car\Model;
use Think\Model;

class CarModel extends Model{
    private $_db = '';
    public function __construct(){
        $this->_db = M('car');
    }

/*
 * 车辆信息的插入
 */
    public function insertCar($data=array()){

        if(!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }


    /*
    *车辆列表加分页
    */
    public function carList($offset,$pageSize){
        return $this->_db
            ->limit($offset,$pageSize)
            ->select();
    }

/*
*通过id查找车辆
*/
    public function getCarById($id){
        return $this->_db
            ->where('id="'.$id.'"')
            ->find();
    }

    //修改车辆信息
    public function editCarById($id,$data){

        if(!$data || !is_array($data)){
            throw_exception("数据不合法");
        }
        return $this->_db->where('id='.$id)->save($data);
    }

    //通过id删除房屋信息
    public function delCarById($id){
        return $this->_db->where('id='.$id)->delete();
    }

}