<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>事件管理</title></title>
	<!-- Bootstrap Core CSS -->
	<link href="/Template/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="/Template/css/style.css" rel='stylesheet' type='text/css' />
	<link href="/Template/css/base.css" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
	<!-- //lined-icons -->
	<script src="/Template/js/jquery-1.10.2.min.js"></script>
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
            <li><a href="/index.php?m=lease&c=list&a=index">事件管理</a></li>
            <li class="active">事件详情</li>
        </ol>
    </div>

			<!-- 头部结束 -->

			<hr size="5px">
			
    <!-- 内容开始 -->
    <div class="courst-content" style="height: 400px;padding: 10px;">
        <div class="courst-content-item">
            <div class="people-info">
                <div class="house-info">
                    <div class="title">
                        事件详情
                    </div>
                    <div class="info-content">
                        <div class="content">
                            编号：<?php echo ($taskInfo["id"]); ?><br>
                            事件发生时间：<?php echo ($taskInfo["starttime"]); ?><br>
                            登记人：<?php echo ($taskInfo["register"]); ?><br>
                            地址：<?php echo ($taskInfo["address"]); ?><br>
                        </div>
                        <div class="content">
                            当事人姓名：<?php echo ($taskInfo["name"]); ?><br>
                            身份证号码：<?php echo ($taskInfo["cardid"]); ?><br>
                            联系电话：<?php echo ($taskInfo["phone"]); ?><br>
                            事件内容：<?php echo (getEventType($taskInfo["eventtype"])); ?><br>
                        </div>
                        <div class="content">
                            事件简述：<?php echo ($taskInfo["eventcontent"]); ?><br>
                            事件简述：<?php echo ($taskInfo["eventresult"]); ?><br>
                            负责人：<?php echo ($taskInfo["fuzeren"]); ?><br>
                            <?php if($taskInfo["iscompele"] == 1): ?>状态：<span style="color: red;">未读</span><br>
                            <?php elseif($taskInfo["iscomplete"] == 2): ?>
                                    状态：<span style="color: red;">待处理<br></span>
                            <?php elseif($taskInfo["iscomplete"] == 3): ?>
                                        状态：<span style="color: red;">待审核</span><br>
                            <?php else: ?>
                                结案时间：<?php echo ($taskInfo["endtime"]); ?><br>
                                审核人：<?php echo ($taskInfo["admin"]); ?><br>
                                状态：<span style="color: red;">已经完成</span><br><?php endif; ?>
                            <input id="taskId" type="hidden" value="<?php echo ($taskInfo["id"]); ?>">
                            <br>
                        </div>
                    </div>
                </div>

                <div class="people-info-operate">
								<span class="input-group-btn">
                                    <!--判断是不是管理员-->
                                    <?php if($_SESSION['admin']['isadmin']!= 1): ?><!--判断完成状态-->
                                        <?php if($taskInfo["iscompele"] == 1): ?><input type="hidden" id="receiveId" value="<?php echo ($taskInfo["id"]); ?>">
                                        <a style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " id="receiveBut" >领取</a>
                                        <?php elseif($taskInfo["iscomplete"] == 2 and $_SESSION['admin']['name']== $taskInfo['fuzeren']): ?>
                                            <a style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " id="completingBtn">处理</a>
                                        <?php else: endif; ?>
                                    <?php else: ?>
                                        <?php if($taskInfo["iscompele"] == 2): ?><input type="hidden" id="tipsId" value="<?php echo ($taskInfo["id"]); ?>">
                                        <a style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " >提醒</a>
                                        <?php elseif($taskInfo["iscomplete"] == 3): ?>
                                            <input type="hidden" id="verifyId" value="<?php echo ($taskInfo["id"]); ?>">
                                            <a style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " id="verify">审核</a>
                                        <?php elseif($taskInfo["iscomplete"] == 4): ?>
                                            <input type="hidden" id="delId" value="<?php echo ($taskInfo["id"]); ?>">
                                            <a style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " id="del">删除</a>
                                            <?php else: endif; endif; ?>
									<a style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " onClick="javascript :history.back(-1);" >返回</a>
								</span>
                </div>
            </div>
        </div>

    </div>
    <!-- 内容结束 -->
<div style="margin-top: 140px;"></div>
<div id="completingDiv" style="width: 100%;height: 100%;display: none">
    <div style="margin:0 auto;width: 360px;height: 160px;margin-top: 10px">
<textarea style="width: 360px;height: 160px;" id="eventResult" name="eventResult"></textarea>
    </div>
</div>


			<!-- 内容结束 -->


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

	
    <script src="/Public/js/task/del.js"></script>
    <script src="/Public/js/task/verify.js"></script>
    <script src="/Public/js/task/receive.js"></script>
    <script src="/Public/js/task/completing.js"></script>


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