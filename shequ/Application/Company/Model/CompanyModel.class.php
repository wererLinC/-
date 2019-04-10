<?php
/**
 * Created by PhpStorm.
 * User: 伟林 陈
 * Date: 2018/5/10
 * Time: 23:37
 */

namespace Company\Model;
use Think\Model;

class CompanyModel extends Model{
    private $_db = '';
    public function __construct(){
        $this->_db = M('company');
    }

/*
 * 企业信息的插入
 */
    public function insertCompany($data=array()){

        if(!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }


    /*
    *企业列表加分页
    */
    public function companyList($offset,$pageSize){
        return $this->_db
            ->limit($offset,$pageSize)
            ->select();
    }

/*
*通过id查找企业
*/
    public function getCompanyById($id){
        return $this->_db
            ->where('id="'.$id.'"')
            ->find();
    }

    //修改企业信息
    public function editCompanyById($id,$data){

        if(!$data || !is_array($data)){
            throw_exception("数据不合法");
        }
        return $this->_db->where('id='.$id)->save($data);
    }

    //通过id删除企业信息
    public function delCompanyById($id){
        return $this->_db->where('id='.$id)->delete();
    }

}