<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>人员修改</title>
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
        <form id="editPeopleInfo"  enctype="multipart/form-data">
            <table class="people-table" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td align="center" colspan="6">天宝社区人员修改</td>
                </tr>
                <tr>
                    <td class="one"  align="center">身份证号码:</td>
                    <td class="two"  align="center"><input type="text" name="cardId" value="<?php echo ($peopleInfo["cardid"]); ?>"></td>
                    <td class="one" align="center">姓名:</td>
                    <td class="two" align="center"><input type="text" name="name" value="<?php echo ($peopleInfo["name"]); ?>"></td>
                    <td class="one" rowspan="4" align="center">照片:</td>
                    <td class="two" rowspan="4" align="center">
                        <img  src="<?php echo ($peopleInfo["picture"]); ?>" id="img_show"  width="135px" height="135px"  >
                        <div style="height: 30px;"></div>
                        <input style="height: 10px;" id="uploadfile"  type="file" name="thumb" data-show-preview="false">
                        <input name="picture" value="" id="file_upload" type="hidden">
                    </td>
                </tr>

                <tr>

                    <td class="one" align="center">户主姓名:</td>
                    <td class="two" align="center"><input type="text" name="ownerName" value="<?php echo ($peopleInfo["ownername"]); ?>"></td>
                    <td class="one" align="center">与户主关系:</td>
                    <td class="two" align="center">
                        <select name="ownerRelative">
                            <?php if($peopleInfo["ownerrelative"] == 1): ?><option value="1" selected>户主</option><?php else: ?><option value="1">户主</option><?php endif; ?>
                            <?php if($peopleInfo["ownerrelative"] == 2): ?><option value="2" selected>妻子</option><?php else: ?><option value="2">妻子</option><?php endif; ?>
                            <?php if($peopleInfo["ownerrelative"] == 3): ?><option value="3" selected>长子</option><?php else: ?><option value="3">长子</option><?php endif; ?>
                            <?php if($peopleInfo["ownerrelative"] == 4): ?><option value="4" selected>次子</option><?php else: ?><option value="4">次子</option><?php endif; ?>
                            <?php if($peopleInfo["ownerrelative"] == 5): ?><option value="5" selected>长女</option><?php else: ?><option value="5">长女</option><?php endif; ?>
                            <?php if($peopleInfo["ownerrelative"] == 6): ?><option value="6" selected>次女</option><?php else: ?><option value="6">次女</option><?php endif; ?>
                        </select>
                    </td>

                <tr>
                    <td class="one" align="center">性别:</td>
                    <td class="two three" align="center">
                        <?php if($peopleInfo["sex"] == 1): ?><input type="radio" name="sex" value="1" checked>男<?php else: ?><input type="radio" name="sex" value="1" >男<?php endif; ?>
                        <?php if($peopleInfo["sex"] == 2): ?><input type="radio" name="sex" value="2" checked>女<?php else: ?><input type="radio" name="sex" value="2" >女<?php endif; ?>
                    </td>
                    <td class="one" align="center">籍贯:</td>
                    <td class="two" align="center"><input type="text" name="origin" value="<?php echo ($peopleInfo["origin"]); ?>"></td>
                </tr>
                <tr>
                    <td class="one" align="center">户籍地:</td>
                    <td class="two" align="center"><input type="text" name="birthLand" value="<?php echo ($peopleInfo["birthland"]); ?>"></td>
                    <td class="one" align="center">民族:</td>
                    <td class="two" align="center"><input type="text" name="nation" value="<?php echo ($peopleInfo["nation"]); ?>"></td>
                </tr>

                <tr>
                    <td class="one" align="center">工作单位:</td>
                    <td class="two" align="center">
                        <input type="text" name="workLand" value="<?php echo ($peopleInfo["workland"]); ?>"></td>
                    <td class="one" align="center">文化程度:</td>
                    <td class="two" align="center">
                        <select name="culture">
                            <?php if($peopleInfo["culture"] == 1): ?><option value="1" selected>本科</option><?php else: ?><option value="1">本科</option><?php endif; ?>
                            <?php if($peopleInfo["culture"] == 2): ?><option value="2" selected>大专</option><?php else: ?><option value="2">大专</option><?php endif; ?>
                            <?php if($peopleInfo["culture"] == 3): ?><option value="3" selected>中专</option><?php else: ?><option value="3">中专</option><?php endif; ?>
                            <?php if($peopleInfo["culture"] == 4): ?><option value="4" selected>专科</option><?php else: ?><option value="4">专科</option><?php endif; ?>
                            <?php if($peopleInfo["culture"] == 5): ?><option value="5" selected>高中</option><?php else: ?><option value="5">高中</option><?php endif; ?>
                            <?php if($peopleInfo["culture"] == 6): ?><option value="6" selected>初中</option><?php else: ?><option value="6">初中</option><?php endif; ?>
                            <?php if($peopleInfo["culture"] == 7): ?><option value="7" selected>研究生</option><?php else: ?><option value="7">研究生</option><?php endif; ?>
                            <?php if($peopleInfo["culture"] == 8): ?><option value="8" selected>硕士</option><?php else: ?><option value="8">硕士</option><?php endif; ?>
                        </select>
                    </td>
                    <td class="one" align="center">政治面貌:</td>
                    <td class="two" align="center">
                        <select name="policy">
                            <?php if($peopleInfo["policy"] == 1): ?><option value="1" selected>中共党员</option><?php else: ?><option value="1">中共党员</option><?php endif; ?>
                            <?php if($peopleInfo["policy"] == 2): ?><option value="2" selected>共青团员</option><?php else: ?><option value="2">共青团员</option><?php endif; ?>
                            <?php if($peopleInfo["policy"] == 3): ?><option value="3" selected>群众</option><?php else: ?><option value="3">群众</option><?php endif; ?>
                            <?php if($peopleInfo["policy"] == 4): ?><option value="4" selected>预备党员</option><?php else: ?><option value="4">预备党员</option><?php endif; ?>
                            <?php if($peopleInfo["policy"] == 5): ?><option value="5" selected>其他民主党派</option><?php else: ?><option value="5">其他民主党派</option><?php endif; ?>
                        </select></td>
                </tr>

                <tr>
                    <td class="one" align="center">党员管辖:</td>
                    <td class="two" align="center">
                        <select name="party">
                            <?php if($peopleInfo["party"] == 1): ?><option value="1" selected>直属</option><?php else: ?><option value="1">直属</option><?php endif; ?>
                            <?php if($peopleInfo["party"] == 2): ?><option value="2" selected>住区</option><?php else: ?><option value="2">住区</option><?php endif; ?>
                            <?php if($peopleInfo["party"] == 3): ?><option value="3" selected>单位</option><?php else: ?><option value="3">单位</option><?php endif; ?>
                        </select></td>
                    <td class="one" align="center">兵役状况:</td>
                    <td class="two" align="center">
                        <select name="army">
                            <?php if($peopleInfo["army"] == 1): ?><option value="1" selected>未服兵役</option><?php else: ?><option value="1">未服兵役</option><?php endif; ?>
                            <?php if($peopleInfo["army"] == 2): ?><option value="2" selected>已服兵役</option><?php else: ?><option value="2">已服兵役</option><?php endif; ?>
                        </select>
                    </td>
                    <td class="one" align="center">人员特征:</td>
                    <td class="two" align="center">
                        <select name="feature">
                            <?php if($peopleInfo["feature"] == 1): ?><option value="1" selected>正常</option><?php else: ?><option value="1">正常</option><?php endif; ?>
                            <?php if($peopleInfo["feature"] == 2): ?><option value="2" selected>关注对象</option><?php else: ?><option value="2">关注对象</option><?php endif; ?>
                            <?php if($peopleInfo["feature"] == 3): ?><option value="3" selected>涉稳人员</option><?php else: ?><option value="3">涉稳人员</option><?php endif; ?>
                            <?php if($peopleInfo["feature"] == 4): ?><option value="4" selected>矫正对象</option><?php else: ?><option value="4">矫正对象</option><?php endif; ?>
                            <?php if($peopleInfo["feature"] == 5): ?><option value="5" selected>精神病人</option><?php else: ?><option value="5">精神病人</option><?php endif; ?>
                            <?php if($peopleInfo["feature"] == 6): ?><option value="6" selected>重点人口</option><?php else: ?><option value="6">重点人员</option><?php endif; ?>
                            <?php if($peopleInfo["feature"] == 7): ?><option value="7" selected>吸毒人员</option><?php else: ?><option value="7">吸毒人员</option><?php endif; ?>
                        </select></td>
                </tr>

                <tr>
                    <td class="one" align="center">公益职务:</td>
                    <td class="two" align="center">
                        <select name="position">
                            <?php if($peopleInfo["position"] == 1): ?><option value="1" selected>楼栋长</option><?php else: ?><option value="1">楼栋长</option><?php endif; ?>
                            <?php if($peopleInfo["position"] == 2): ?><option value="2" selected>小组长</option><?php else: ?><option value="2">小组长</option><?php endif; ?>
                            <?php if($peopleInfo["position"] == 3): ?><option value="3" selected>志愿者</option><?php else: ?><option value="3">志愿者</option><?php endif; ?>
                            <?php if($peopleInfo["position"] == 4): ?><option value="4" selected>信息员</option><?php else: ?><option value="4">信息员</option><?php endif; ?>
                        </select></td>
                    <td class="one" align="center">婚姻状况:</td>
                    <td class="two" align="center">
                        <select name="marrige">
                            <?php if($peopleInfo["marrige"] == 1): ?><option value="1" selected>初婚</option><?php else: ?><option value="1">初婚</option><?php endif; ?>
                            <?php if($peopleInfo["marrige"] == 2): ?><option value="2" selected>离婚</option><?php else: ?><option value="2">离婚</option><?php endif; ?>
                            <?php if($peopleInfo["marrige"] == 3): ?><option value="3" selected>未婚</option><?php else: ?><option value="3">未婚</option><?php endif; ?>
                            <?php if($peopleInfo["marrige"] == 4): ?><option value="4" selected>再婚</option><?php else: ?><option value="4">再婚</option><?php endif; ?>
                            <?php if($peopleInfo["marrige"] == 5): ?><option value="5" selected>其他</option><?php else: ?><option value="5">其他</option><?php endif; ?>

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
                <input type="hidden" name="id" value="<?php echo ($peopleInfo["id"]); ?>">
                <tr>
                    <td class="one" colspan="6" align="center">
                        <input style="width: 80px;height: 40px;text-align: center;cursor: pointer"  onclick="editInfo.edit()" value="确定">
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
<script src="/Public/js/people/image.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/dialog/layer.js"></script>
<script src="/Public/js/people/editInfo.js"></script>
</body>
</html>