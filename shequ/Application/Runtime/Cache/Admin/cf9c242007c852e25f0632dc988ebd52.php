<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>社区首页</title>
	<!-- Bootstrap Core CSS -->
	<link href="/Template/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="/Template/css/style.css" rel='stylesheet' type='text/css' />
	<link href="/Template/css/base.css" rel='stylesheet' type='text/css' />
	<script src="/Template/js/jquery.min.js"></script>

	<!-- Graph CSS -->
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
					<li><a href="/index.php?m=admin&c=file&a=imgList">图片管理</a></li>
					<li class="active">图片搜索列表</li>
				</ol>
			</div>
			<hr size="5px">
				<!-- 内容开始 -->
				<div class="courst-content" style="height: 540px;padding: 10px;">
<!--TODO-->
					<div class="imgListDiv" style="width: 80%;height: 500px;margin: 0 auto;margin-right:100px;border: 1px solid #FFFFFF">
					<?php if($imgInfo != null): if(is_array($imgInfo)): $i = 0; $__LIST__ = $imgInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgInfo): $mod = ($i % 2 );++$i;?><div class="content-item" style="border-radius: 5%;width: 133px;height: 150px;">
								<img id="imgBut" attr-id="<?php echo ($imgInfo["url"]); ?>" style="width: 130px;height: 120px;" src="/Uploads<?php echo ($imgInfo["url"]); ?>">
								<span style="line-height: 30px;font-size: 12px;padding-left: 20%;color:#D7B6E2"><?php echo ($imgInfo["imgname"]); ?></span><span style="margin-right: 10px;line-height: 30px;float: right;color: red;z-index: 10000;" id="delImgBut" attr-id="<?php echo ($imgInfo["id"]); ?>" class="glyphicon glyphicon-remove-circle"></span>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
						<!-- 分页 -->
						<div class="page" style="position: absolute;top: 580px;left: 100px;">
							<ul class="pagination">
								<?php echo ($pageRes); ?>
							</ul>
						</div>
						<!-- 分页结束 -->
						<?php else: ?>
						没有记录<?php endif; ?>
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
	<!--点击放大图片按钮-->
	<div id="exImg" style="display: none;width: 100%;max-height: 400px;overflow: hidden">
			<img id="imgShow" src="" style="width: 100%;height: 100%">
	</div>
	<!--点击放大图片按钮-->
	

	

	<!-- Bootstrap Core JavaScript -->
	<script src="/Template/js/jquery.min.js"></script>
	<script src="/Template/js/bootstrap.min.js"></script>
	<script src="/Public/js/dialog.js"></script>
	<script src="/Public/js/dialog/layer.js"></script>
	<script src="/Public/js/admin/file/delImg.js"></script>

	<!--导航条-->
	<script>
		//搜索函数
		$('#searchButton').on('click',function () {
			var searchContent = $('input[name="searchContent"]').val();
				//不是数字那就是名字来查
				window.location.href='/index.php?m=admin&c=search&a=img&imgName='+searchContent;
		})

		//图片放大层
		$('.imgListDiv #imgBut').on('click',function () {
			var url = $(this).attr('attr-id');
			$('#exImg #imgShow').attr('src','/Uploads'+url);
			layer.open({
				type: 1,
				title: false,
				closeBtn: 1,
				area: '516px',
				skin: 'layui-layer-nobg', //没有背景色
				shadeClose: true,
				content: $('#exImg')
			});
		})



		$(document).ready(function(){

			$("#nav > li a").each(function(){
				$this = $(this).parents('#nav > li');
				if(this.href==window.location.href){
					$this.addClass("active");
				}
			});
		});
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