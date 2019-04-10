<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
<title>人员添加</title>
<!-- Bootstrap Core CSS -->
<link href="/Template/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="/Template/css/style.css" rel='stylesheet' type='text/css' />
<link href="/Template/css/base.css" rel='stylesheet' type='text/css' />
<link href="/Template/css/renyuan.css" rel='stylesheet' type='text/css' />
    <link href="/Public/js/dialog/skin/layer.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="/Template/fileinput/fileinput.min.css">
<!-- Graph CSS -->
<style type="text/css">
	.modal-dialog-box{
            width: 100%;
            height: 100%;
        }
        .pagination{
            padding: 0;
            margin: 0;
        }
</style>
</head> 
<body>

<div class="page-container" style="min-width: 80%; padding-top: 30px;">
                <div class="cont-content" style="width: 1400px; margin: auto;padding-top: 30px">
                    <form id="peopleInfo"  enctype="multipart/form-data">
                        <table class="people-table" cellspacing="0" cellpadding="0">
                            <tbody>
                            <input type="hidden" name="roomType" value="1">
                            <input type="hidden" name="community" value="<?php echo ($_SESSION['admin']['community']); ?>">
                                <tr>
                                    <td align="center" colspan="6">
                                        <?php if(is_array($community)): $i = 0; $__LIST__ = $community;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$community): $mod = ($i % 2 );++$i; if($_SESSION['admin']['community']== $community[id]): echo ($community["community"]); endif; endforeach; endif; else: echo "" ;endif; ?>
                                        长住户登记</td>
                                </tr>
                            <tr>
                            	<td class="one"  align="center">身份证号码:</td>
                                <td class="two"  align="center"><input type="text" name="cardId"></td>
                                <td class="one" align="center">姓名:</td>
                                <td class="two" align="center"><input type="text" name="name"></td>
                                <td class="one" rowspan="4" align="center">照片:</td>
                                <td class="two" rowspan="4" align="center">
                                    <img  src="" id="img_show"  width="135px" height="135px" style="display:none;" >
                                    <div style="height: 30px;"></div>
                                    <input style="height: 10px;" id="uploadfile"  type="file" name="thumb" data-show-preview="false">
                                    <input name="picture" value="" id="file_upload" type="hidden">
                                </td>
                            </tr>
                           
                            <tr>
                                
                                <td class="one" align="center">户主姓名:</td>
                                <td class="two" align="center"> <?php if($ownerName == null): ?><input type="text" name="ownerName" ><?php else: ?><input type="text" name="ownerName" value="<?php echo ($ownerName); ?>"><?php endif; ?></td>
                                <td class="one" align="center">与户主关系:</td>
                                <td class="two" align="center">
                                    <select name="ownerRelative">
                                        <option value="1" check>户主</option>
                                        <option value="2">妻子</option>
                                        <option value="3">长子</option>
                                        <option value="4">次子</option>
                                        <option value="5">长女</option>
                                        <option value="6">次女</option>
                                    </select>
                                </td>

                            <tr>
                                <td class="one" align="center">性别:</td>
                                <td class="two three" align="center">
                                    <input type="radio" name="sex" value="1" checked>男
                                    <input type="radio" name="sex" value="2" >女
                                </td>
                                <td class="one" align="center">籍贯:</td>
                                <td class="two" align="center"><input type="text" name="origin"></td>       
                            </tr>
                            <tr>
                                <td class="one" align="center">户籍地:</td>
                                <td class="two" align="center"><input type="text" name="birthLand"></td>
                                <td class="one" align="center">民族:</td>
                                <td class="two" align="center"><input type="text" name="nation"></td>                        
                            </tr>

                            <tr>
                                <td class="one" align="center">工作单位:</td>
                                <td class="two" align="center">
                                    <input type="text" name="workLand"></td>
                                <td class="one" align="center">文化程度:</td>
                                <td class="two" align="center">
                                    <select name="culture">
                                        <option  value="1" check>本科</option>
                                        <option  value="2">大专</option>
                                        <option  value="3">中专</option>
                                        <option  value="4">专科</option>
                                        <option  value="5">高中</option>
                                        <option  value="6">初中</option>
                                        <option  value="7">研究生</option>
                                        <option  value="8">硕士</option>
                                    </select>
                                </td>
                                <td class="one" align="center">政治面貌:</td>
                                <td class="two" align="center">
                                    <select name="policy">
                                        <option value="1" check>中共党员</option>
                                        <option value="2">共青团员</option>
                                        <option value="3">群众</option>
                                        <option value="4">预备党员</option>
                                        <option value="5">其他民主党派</option>
                                    </select></td>                      
                            </tr>

                            <tr>
                                <td class="one" align="center">党员管辖:</td>
                                <td class="two" align="center">
                                    <select name="party">
                                        <option value="1" check>直属</option>
                                        <option value="2">住区</option>
                                        <option value="3">单位</option>
                                    </select></td>
                                <td class="one" align="center">兵役状况:</td>
                                <td class="two" align="center">
                                    <select name="army">
                                        <option value="1" check>未服兵役</option>
                                        <option value="2">已服兵役</option>
                                    </select>
                                </td>
                                <td class="one" align="center">人员特征:</td>
                                <td class="two" align="center">
                                    <select name="feature">
                                        <option value="1" check>正常</option>
                                        <option value="2">关注对象</option>
                                        <option value="3">涉稳人员</option>
                                        <option value="4">矫正对象</option>
                                        <option value="5">精神病人</option>
                                        <option value="6">重点人口</option>
                                        <option value="7">吸毒人员</option>
                                    </select></td>                          
                            </tr>

                            <tr>
                                <td class="one" align="center">公益职务:</td>
                                <td class="two" align="center">
                                    <select name="position">
                                        <option value="1" check>楼栋长</option>
                                        <option value="2">小组长</option>
                                        <option value="3">志愿者</option>
                                        <option value="4">信息员</option>
                                    </select></td>    
                                <td class="one" align="center">婚姻状况:</td>
                                <td class="two" align="center">
                                    <select name="marrige">
                                        <option value="1" check>初婚</option>
                                        <option value="2">离婚</option>
                                        <option value="3">未婚</option>
                                        <option value="4">再婚</option>
                                        <option value="5">其他</option>
                                    </select></td>
                                </td>
                                <td class="one" colspan="1" align="center">兴趣爱好:</td>
                                <td class="two" rol="2" align="center">
                                    <textarea rows="3" name="interst"></textarea>
                                </td></td>
                            </tr>

                            <tr>

                                <td class="one" colspan="2" align="center">人员特征简介:</td>
                                <td class="two" rol="2" align="center">
                                    <textarea rows="3" name="featureDes"></textarea>
                                </td></td>
                                <td class="one" colspan="2" align="center">备注:</td>
                                <td class="two" colspan="2" align="left" style="position: relative">
                                    <textarea rows="3" cols="40" name="note"></textarea>
                            </tr>

                            <tr>
                               <td class="one" colspan="6" align="center">
                                   <input style="width: 80px;height: 40px;text-align: center;cursor: pointer"  onclick="addInfo.add()" value="确定">
                                   <input style="width: 80px;height: 40px;text-align: center;cursor: pointer"  onclick="javascript :history.back(-1);" value="返回">
                               </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

<script src="/Template/js/jquery.min.js"></script>
<script src="/Template/fileinput/fileinput.min.js"></script>
<script src="/Template/fileinput/fileinput_locale_zh.js"></script>
<script src="/Public/js/people/addInfo.js"></script>
<script src="/Public/js/people/image.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/dialog/layer.js"></script>
</body>
</html>