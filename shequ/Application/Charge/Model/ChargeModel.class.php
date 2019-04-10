<?php
/**
 * Created by PhpStorm.
 * User: 伟林 陈
 * Date: 2018/5/10
 * Time: 23:37
 */

namespace Charge\Model;
use Think\Model;

class ChargeModel extends Model{
    private $_db = '';
    public function __construct(){
        $this->_db = M('charge');
    }


    /*
    *收费列表加分页
    */
    public function chargeList($offset,$pageSize){
        return $this->_db
            ->limit($offset,$pageSize)
            ->select();
    }

/*
*通过id收费房屋
*/
    public function chargeById($id){
        return $this->_db
            ->where('id="'.$id.'"')
            ->find();
    }

    //更新收费信息
    public function editChargeById($id,$data){

        if(!$data || !is_array($data)){
            throw_exception("数据不合法");
        }
        return $this->_db->where('id='.$id)->save($data);
    }

    //通过id删除收费信息
    public function delChargeById($id){
        return $this->_db->where('id='.$id)->delete();
    }

}