<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>收费管理</title></title>
	<!-- Bootstrap Core CSS -->
	<link href="/Template/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="/Template/css/style.css" rel='stylesheet' type='text/css' />
	<link href="/Template/css/base.css" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
	<!-- //lined-icons -->
	<script src="/Template/js/jquery.min.js"></script>
	<style type="text/css">
		.modal-dialog-box{
			width: 1000px;
			height: 100%;
		}
		.pagination{
			padding: 0;
			margin: 0;
		}
	</style>
</head>
<body style="font-size: 12px;">
<div class="page-container" style="min-width: 80%;">
	<!--/content-inner-->
	<div class="left-content">
		<div class="inner-content">
			<!-- header-starts -->
			<div class="header-section">
				<!-- top_bg -->
				<div class="top_bg">
					<div class="header_top">
						<div class="top_right">
							<ul>
								<li><a href="">联系电话：17720743412</a></li>|
								<li><a class="mouse-a" data-toggle="modal" data-target="#help">帮助</a></li>|
								<li><a href="/index.php?m=home&c=login&a=logout">退出</a></li>
							</ul>
						</div>
						<div class="top_left">
							<input type="hidden" id="isAdmin" value="<?php echo ($_SESSION['admin']['isadmin']); ?>">
							<span style="color: white;cursor: pointer" class="glyphicon glyphicon-bell" onclick="javascript:location.href='/index.php?m=task&c=list&a=index' "></span>
							<?php if($taskCount == 0): else: ?>
								<sup style="color: red"><?php echo ($taskCount); ?></sup><?php endif; ?>
							<span style="color: white;margin-left: 15px;cursor: pointer;font-size: 14px" onclick="javascript:location.href='/index.php?m=admin&c=information&a=index&id=<?php echo ($_SESSION['admin']['id']); ?>'">个人中心</span>
						</div>
						<div class="clearfix"> </div>
					</div>

				</div>
			</div>

			<div class="clearfix"></div>

			
    <div class="courst-bread" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li><a href="/index.php">首页</a></li>
            <li><a href="/index.php?m=charge&c=list&a=index">收费管理</a></li>
            <li class="active">收费搜索</li>
        </ol>
    </div>


			<hr size="5px">
			
    <!-- 内容 -->
    <div class="courst-content" style="height: 550px;padding: 10px;">

        <div class="courst-contenr-border">

            <table class="table-position table  table-bordered table-hover" style="width: 100%;margin: 0 auto; ">
                <tbody style="background-color: #FBFCFC;text-align: center;">
                <tr>
                    <th style="text-align: center;">房屋地址</th>
                    <th style="text-align: center;">小区名称</th>
                    <th style="text-align: center;">楼栋·单元·室</th>
                    <th style="text-align: center;">户主姓名</th>
                    <th style="text-align: center;">收费时间</th>
                    <th style="text-align: center;">收费金额</th>
                    <th style="text-align: center;">收费人</th>
                    <th style="text-align: center;">收费状态</th>

                </tr>
                <?php if($chargeInfo != null): if(is_array($chargeInfo)): $i = 0; $__LIST__ = $chargeInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chargeInfo): $mod = ($i % 2 );++$i;?><tr  class="chargeTable" style="font-size: 12px;color: #8C8C8C;cursor: pointer;">
                            <td id="address" onclick="javascript:location.href='/index.php?m=charge&c=information&a=index&id=<?php echo ($chargeInfo["id"]); ?>'"><?php echo ($chargeInfo["address"]); ?></td>
                            <td id="community" onclick="javascript:location.href='/index.php?m=charge&c=information&a=index&id=<?php echo ($chargeInfo["id"]); ?>'"><?php echo (getCommunity($chargeInfo["community"])); ?></td>
                            <td id="buildNum" onclick="javascript:location.href='/index.php?m=charge&c=information&a=index&id=<?php echo ($chargeInfo["id"]); ?>'"><?php echo ($chargeInfo["buildnum"]); ?>--<?php echo ($chargeInfo["unitnum"]); ?>--<?php echo ($chargeInfo["roomnum"]); ?></td>
                            <td id="name" onclick="javascript:location.href='/index.php?m=charge&c=information&a=index&id=<?php echo ($chargeInfo["id"]); ?>'"><?php echo ($chargeInfo["name"]); ?></td>
                            <td id="time" onclick="javascript:location.href='/index.php?m=charge&c=information&a=index&id=<?php echo ($chargeInfo["id"]); ?>'"><?php echo ($chargeInfo["time"]); ?></td>
                            <td id="money" onclick="javascript:location.href='/index.php?m=charge&c=information&a=index&id=<?php echo ($chargeInfo["id"]); ?>'"><?php echo ($chargeInfo["money"]); ?></td>
                            <td id="admin" onclick="javascript:location.href='/index.php?m=charge&c=information&a=index&id=<?php echo ($chargeInfo["id"]); ?>'"><?php echo ($chargeInfo["admin"]); ?></td>
                            <td id="operate"><?php if($chargeInfo["ischarge"] == 1): ?>已缴交<?php endif; ?>
                                <?php if($chargeInfo["ischarge"] == 0 and $chargeInfo["money"] != 0): ?><a id="conformCharge"  attr-id="<?php echo ($chargeInfo["id"]); ?>">确定收费</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a id="editChargeBut" class="mouse-a" data-toggle="modal" attr-id="<?php echo ($chargeInfo["id"]); ?>" data-target="#editCharge">修改金额</a><?php endif; ?>
                                <?php if($chargeInfo["money"] == 0 and $chargeInfo["ischarge"] == 0): ?><a id="addChargeBut" attr-id="<?php echo ($chargeInfo["id"]); ?>" class="mouse-a" data-toggle="modal" data-target="#addCharge">添加收费</a><?php endif; ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr  style="text-align: center;">
                        <td colspan="8">
                            <ul class="pagination" >
                                <?php echo ($pageRes); ?>
                            </ul>
                        </td>
                    </tr>
                    <?php else: ?>
                    <td colspan="8">暂无信息</td><?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- 内容结束 -->
    <!--  收费（Modal） -->
    <div class="modal fade" id="addCharge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                        收费金额
                    </h4>
                </div>
                <div class="modal-body" style="text-align: center">
                    <form>
                        <input id="chargeId" type="hidden" name="id" value="">
                        <input name="money" type="text" style="text-align: center;width: 100px;margin-right: 10px;" placeholder="请输入收费金额">元
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="addCharge.add()">确定
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--收费结束-->
    <!--  修改收费（Modal） -->
    <div class="modal fade" id="editCharge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 12%;width: 400px;margin-left: 60%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                        修改金额
                    </h4>
                </div>
                <div class="modal-body" style="text-align: center">
                    <form>
                        <input id="editChargeId" type="hidden" name="editId" value="">
                        <input name="editMoney" type="text" style="text-align: center;width: 100px;margin-right: 10px;" value="<?php echo ($chargeInfo["money"]); ?>">元
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="searchEditCharge.edit()">确定
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--收费结束-->

			<!-- 内容结束 -->
			<!-- 页脚 -->
			<div class="courst-foot" >
				<div class="foot-des">
					<p>&copy;weierlin | 2018</p>
				</div>
			</div>
			<!-- 页脚结束 -->

			<!-- <!-- 帮助（Modal） -->
			<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel" style="text-align: center">
								帮助中心
							</h4>
						</div>
						<div class="modal-body" style="text-align: center">
							关于该软件，必须配置有flash的插件，最好是用当下流行的浏览器，谷歌，火狐等，尽量不要使用ie
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭
							</button>
						</div>
					</div><!-- /.modal-content
    </div><!-- /.modal -->
					<!-- </div> -->
					<!--帮助结束-->
				</div>
			</div>
		</div>


		<!-- 左边菜单 -->
		<div class="sidebar-menu" style="min-width: 14%;">
			<div class="menu">
				<ul id="menu" >
					<li><a><span class="glyphicon glyphicon-asterisk"></span>&nbsp;<span>菜单管理</span></a></li>

					<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;<span>添加信息</span> <span class="fa fa-angle-right" style="float: right">&gt;</span></a>

					</li>

					<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;<span> 人员</span> <span class="fa fa-angle-right" style="float: right">&gt;</span></a>

					</li>

					<li><a href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<span> 房屋</span><span class="fa fa-angle-right" style="float: right">&gt;</span></a>

					</li>

					<li><a href="#"><span class="glyphicon glyphicon-plane"></span>&nbsp;<span>车辆</span><span class="fa fa-angle-right" style="float: right">&gt;</span></a>

					</li>

					<li><a href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<span>任务</span><span class="fa fa-angle-right" style="float: right">&gt;</span></a>

					</li>

			</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<!-- Bootstrap Core JavaScript -->
	<script src="/Template/js/bootstrap.min.js"></script>
	<script src="/Public/js/dialog/layer.js"></script>
	<script src="/Public/js/dialog.js"></script>

	
    <script src="/Public/js/charge/charged.js"></script>
    <script src="/Public/js/charge/searchEditCharge.js"></script>
    <script src="/Public/js/charge/addCharge.js"></script>
    <script type="text/javascript">
        $('.chargeTable #addChargeBut').on('click',function () {
            var id = $(this).attr('attr-id');
            $('#chargeId').attr('value',id);
        })

        $('.chargeTable #editChargeBut').on('click',function () {
            var id = $(this).attr('attr-id');
            $('#editChargeId').attr('value',id);
        })

    </script>


	<script type="text/javascript">
		<!--定时向后台访问，看有没有未读或者未处理事件-->
		var num = Math.round(Math.random()*90+60);
		//循环执行，每隔60-150秒钟执行一次showMsgIcon()
		window.setInterval(taskTip, 5000*num);
		function taskTip(){
			$isAdmin = $('#isAdmin').val();
			postData={
				'isAdmin':$isAdmin,
			}
			url = '/index.php?m=home&c=index&a=task';
			$.post(url,postData,function (result) {
				if(result.status == 0){
					window.location.reload();
				}else if(result.status == 1){
					layer.open({
						content : result.message,
						icon : 1,
						yes : function(){
							clearInterval(taskTip);
							location.href='/index.php?m=task&c=list&a=index';
						},
					});
				}else if(result.status == 2){
					layer.open({
						content : result.message,
						icon : 1,
						yes : function(){
							clearInterval(taskTip);
							location.href='/index.php?m=task&c=list&a=completing';
						},
					});
				}
				else if(result.status == 3){
					layer.open({
						content : result.message,
						icon : 1,
						yes : function(){
							clearInterval(taskTip);
							location.href='/index.php?m=task&c=list&a=verify';
						},
					});
				}
			},"JSON");
		}

	</script>
</body>
</html>