<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>企业管理</title></title>
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

			<!-- 面包屑 -->
			<div class="courst-bread" style="margin-top: 20px;">
				<ol class="breadcrumb">
					<li><a href="/index.php">首页</a></li>
					<li><a href="/index.php?m=company&c=list&a=index">企业管理</a></li>
					
    <li class="active">企业详情</li>

				</ol>
			</div>
			<!-- 面包屑结束 -->
			<!-- 头部结束 -->

			<hr size="5px">
			
    <!-- 内容开始 -->
    <div class="courst-content" style="height: 400px;">
        <div class="courst-content-item">
            <div class="people-info">
                <div class="renyuan-info">
                    <div class="title">
                        企业信息
                    </div>
                    <div class="info-content">
                        <div class="content">
                            法人身份证号码：<?php echo ($companyInfo["usecardid"]); ?><br>
                            法人姓名：<?php echo ($companyInfo["usename"]); ?><br>
                            法人电话：<?php echo ($companyInfo["usephone"]); ?><br>
                            政治面貌：<?php echo (getPolicy($companyInfo["policy"])); ?>
                        </div>
                        <div class="content">
                            注册资本：<?php echo ($companyInfo["capital"]); ?><br>
                            从业人员：<?php echo ($companyInfo["staff"]); ?><br>
                            社会信用代码：<?php echo ($companyInfo["creditnumber"]); ?><br>
                            注册时间：<?php echo ($companyInfo["regdata"]); ?>
                        </div>
                        <div class="content">
                            <input type="hidden" id="companyId" value="<?php echo ($companyInfo["id"]); ?>">
                            房屋地址：<br>
                            <a style="margin-left: 60px;" href="/index.php?m=house&c=information&a=index&id=<?php echo ($houseInfo["id"]); ?>"><?php echo (getCommunity($houseInfo["community"])); echo ($houseInfo["buildnum"]); echo ($houseInfo["unitnum"]); echo ($houseInfo["roomnum"]); ?><br></a>
                            <div class="content-operate">
                                <a href="/index.php?m=company&c=edit&a=index&id=<?php echo ($companyInfo["id"]); ?>">修改</a>
                                <a id="del" style="cursor: pointer;margin-left: 10px;" onclick="delInfo.del()">删除</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="people-info-operate">
								<span class="input-group-btn">
									<button style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " onclick="javascript:history.back(-1);">返回</button>
								</span>
                </div>
            </div>
        </div>

    </div>
    <!-- 内容结束 -->
    <div style="margin-top: 140px;"></div>

			<!-- 内容结束 -->

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

	
    <script src="/Public/js/company/delInfo.js"></script>


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