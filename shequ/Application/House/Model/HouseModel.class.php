<?php
/**
 * Created by PhpStorm.
 * User: 伟林 陈
 * Date: 2018/5/10
 * Time: 23:37
 */

namespace House\Model;
use Think\Model;

class HouseModel extends Model{
    private $_db = '';
    public function __construct(){
        $this->_db = M('house');
    }

/*
 * 房屋信息的插入
 */
    public function insertHouse($data=array()){

        if(!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }


    /*
    *房屋列表加分页
    */
    public function HouseList($offset,$pageSize){
        return $this->_db
            ->limit($offset,$pageSize)
            ->select();
    }

/*
*通过id查找房屋
*/
    public function houseById($id){
        return $this->_db
            ->where('id="'.$id.'"')
            ->find();
    }

    //修改房屋信息
    public function editHouseById($id,$data){

        if(!$data || !is_array($data)){
            throw_exception("数据不合法");
        }
        return $this->_db->where('id='.$id)->save($data);
    }

    //通过id删除房屋信息
    public function delHouseById($id){
        return $this->_db->where('id='.$id)->delete();
    }

}