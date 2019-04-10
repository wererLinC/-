<?php
/**
 * Created by PhpStorm.
 * User: 伟林 陈
 * Date: 2018/5/10
 * Time: 23:37
 */

namespace User\Model;
use Think\Model;

class UserModel extends Model{
    private $_db = '';
    public function __construct(){
        $this->_db = M('admin');
    }



//完善
    public function wanShanById($id,$data){

        if(!$data || !is_array($data)){
            throw_exception("数据不合法");
        }
        return $this->_db->where('id='.$id)->save($data);
    }
}