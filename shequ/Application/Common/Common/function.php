<?php
/**
 * 公用方法的封装
 */

function show($status,$message,$data=array()){
    $result=array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );
        exit(json_encode($result));
}


/**
 * TODO 基础分页的相同代码封装，使前台的代码更少
 * @param $count 要分页的总记录数
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage($count, $pagesize = 10) {
    $p = new Think\Page($count, $pagesize);
    $p->setConfig('header', '<div style="padding: 5px">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
    $p->setConfig('prev', '上一页');
    $p->setConfig('next', '下一页');
    $p->setConfig('last', '末页');
    $p->setConfig('first', '首页');
    $p->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
    $p->lastSuffix = false;//最后一页不显示为总页数
    return $p;
}




    function getIsAdmin($type)
    {
        if ($type == 1) {
            return $type = "系统信息";
        }
        if ($type == 0) {
            return $type = "普通信息";
        }
    }

    /*
     *显示房屋信息
     */
function getCommunity($type){
    if($type == 1){
        return $type ="天宝";
    }
    if($type == 2){
        return $type ="福清";
    }
}

function getRoomType($type)
{
    if ($type == 1) {
        return $type = "长住户";
    }
    if ($type == 2) {
        return $type = "户籍户";
    }
    if ($type == 3) {
        return $type = "出租户";
    }
    if ($type == 4) {
        return $type = "暂住户";
    }
    if ($type == 5) {
        return $type = "未驻入";
    }
}

/*
 *显示人员信息
 */

//性别
function getSex($type)
{
    if ($type == 1) {
        return $type = "男";
    }
    if ($type == 2) {
        return $type = "女";
    }
}

//获取与户主关系
function getRelative($type){
    if ($type == 1) {
        return $type = "户主";
    }
    if ($type == 2) {
        return $type = "妻子";
    }
    if ($type == 3) {
        return $type = "长子";
    }
    if ($type == 4) {
        return $type = "次子";
    }
    if ($type == 5) {
        return $type = "长女";
    }
    if ($type == 6) {
        return $type = "次女";
    }
}

//婚姻状况
function getMarrige($type){
    if ($type == 1) {
        return $type = "初婚";
    }
    if ($type == 2) {
        return $type = "离婚";
    }
    if ($type == 3) {
        return $type = "未婚";
    }
    if ($type == 4) {
        return $type = "再婚";
    }
    if ($type == 5) {
        return $type = "其他";
    }

}

//文化状况
function getCulture($type){
    if ($type == 1) {
        return $type = "本科";
    }
    if ($type == 2) {
        return $type = "大专";
    }
    if ($type == 3) {
        return $type = "中专";
    }
    if ($type == 4) {
        return $type = "专科";
    }
    if ($type == 5) {
        return $type = "高中";
    }
    if ($type == 6) {
        return $type = "初中";
    }
    if ($type == 7) {
        return $type = "研究生";
    }
    if ($type == 8) {
        $type = "硕士";
    }
}

//政治面貌
function getPolicy($type){
    if ($type == 1) {
        return $type = "中共党员";
    }
    if ($type == 2) {
        return $type = "共青团员";
    }
    if ($type == 3) {
        return $type = "群众";
    }
    if ($type == 4) {
        return $type = "预备党员";
    }
    if ($type == 5) {
        return $type = "其他民主党派";
    }
}

//党员管辖
function getParty($type){
    if ($type == 1) {
        return $type = "直属";
    }
    if ($type == 2) {
        return $type = "住区";
    }
    if ($type == 3) {
        return $type = "单位";
    }
}

//兵役状况
function getArmy($type){
    if ($type == 1) {
        return $type = "未服兵役";
    }
    if ($type == 2) {
        return $type = "已服兵役";
    }
}

//人员特征
function getFeature($type){
    if ($type == 1) {
        return $type = "正常";
    }
    if ($type == 2) {
        return $type = "关注对象";
    }
    if ($type == 3) {
        return $type = "涉稳人员";
    }
    if ($type == 4) {
        return $type = "矫正对象";
    }
    if ($type == 5) {
        return $type = "精神病人";
    }
    if ($type == 6) {
        return $type = "重点人口";
    }
    if ($type == 7) {
        return $type = "吸毒人员";
    }
}

//职位
    function getPosition($type){
        if ($type == 1) {
            return $type = "无";
        }
        if ($type == 2) {
            return $type = "楼栋长";
        }
        if ($type == 3) {
            return $type = "小组长";
        }
        if ($type == 4) {
            return $type = "信息员";
        }
}

//车辆信息
function getCarType($type)
{
    if ($type == 1) {
        return $type = "小汽车";
    }
    if ($type == 2) {
        return $type = "摩托车";
    }
    if ($type == 3) {
        return $type = "自行车";
    }
    if ($type == 4) {
        return $type = "电动车";
    }
}

/*
 *
 * 出租信息
 */

//出租类型
function getLeaseType($type)
{
    if ($type == 1) {
        return $type = "个人";
    }
    if ($type == 2) {
        return $type = "单位";
    }
}

//出租用途
function getLeaseUse($type)
{
    if ($type == 1) {
        return $type = "居住";
    }
    if ($type == 2) {
        return $type = "办公";
    }
    if ($type == 3) {
        return $type = "商用";
    }
    if ($type == 4) {
        return $type = "其他";
    }
}

function getEventType($type){
    if ($type == 1) {
        return $type = "物业管理";
    }
    if ($type == 2) {
        return $type = "邻里纠纷";
    }
    if ($type == 3) {
        return $type = "投诉";
    }
    if ($type == 4) {
        return $type = "建议";
    }
}

function getQiaoLianType($type){
    if ($type == 1) {
        return $type = "华侨";
    }
    if ($type == 2) {
        return $type = "港澳台";
    }
    if ($type == 3) {
        return $type = "外籍";
    }
    if ($type == 4) {
        return $type = "留学生";
    }
}




