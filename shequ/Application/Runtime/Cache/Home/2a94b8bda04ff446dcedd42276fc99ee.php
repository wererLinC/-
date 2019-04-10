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
<link href="/Template/css/courst.css" rel='stylesheet' type='text/css' />
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
	#exCommunity:hover{
		background: #cccccc;
	}

</style>
</head>
<body>
<div class="page-container" style="min-width: 80%;">
   <!--/content-inner-->
	<div class="left-content">
	   <div class="inner-content">
		<!-- header-starts -->
				<div class="header-section">
			<!-- top_bg -->
					<div style="font-size: 12px;" class="top_bg">
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
										<sup style="color: red"><?php echo ($unTaskCount); ?></sup><?php endif; ?>
									<span style="color: white;margin-left: 15px;cursor: pointer;" onclick="javascript:location.href='/index.php?m=admin&c=information&a=index&id=<?php echo ($_SESSION['admin']['id']); ?>'">个人中心</span>
								</div>
									<div class="clearfix"> </div>
							</div>

					</div>
				</div>

				<div class="clearfix"></div>

	<!-- 头部 -->
	
				<div class="courst-header" style="position: relative;">
					<div class="item">
	                    <img style="cursor: pointer" onclick="javascript:location.href='/index.php?m=admin&c=information&a=index&id=<?php echo ($_SESSION['admin']['id']); ?>'"  src="<?php echo ($_SESSION['admin']['picture']); ?>" alt="<?php echo ($_SESSION['admin']['name']); ?>" ／>
	                    <div class="item-info">
							<?php if($_SESSION['admin']['policy']== 1): ?><img style="width: 20px;height: 18px;" src="/Template/img/1.png"><?php else: endif; ?>
	                      <div class="item-name"><?php echo ($_SESSION['admin']['name']); ?><span class="item-level">【<?php echo ($_SESSION['admin']['position']); ?>】</span></div>
	                      <div class="item-phone">电话：<?php echo ($_SESSION['admin']['phone']); ?></div>
	                      <div class="item-address">[地址]<?php echo ($_SESSION['admin']['birthland']); ?></div>
	                    </div>
                  	</div>
                  	<div class="item-task" style="font-size: 18px;color: #8C8C8C;">
                  	 	管辖小区&nbsp;&nbsp;|&nbsp;&nbsp;<?php if(is_array($community)): $i = 0; $__LIST__ = $community;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$community): $mod = ($i % 2 );++$i; if($_SESSION['admin']['community']== $community[id]): ?><span ><?php echo ($community["community"]); ?></span><?php endif; endforeach; endif; else: echo "" ;endif; ?>&nbsp;&nbsp;<?php if($_SESSION['admin']['isadmin']== 1): ?><span style="color: #F9BC2C;font-size: 14px;cursor: pointer" id="communityBut">切换</span><?php else: endif; ?>
					</div>


					<!--书记特有的切换社区的按钮-->

					<div  id="communityMenu" class="communityMenu" style="display: none;text-align: center;padding: 8px;position: absolute;right: 28px;top: 98px;background: #EEEEEE">
						<?php if(is_array($communitys)): $i = 0; $__LIST__ = $communitys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$communitys): $mod = ($i % 2 );++$i;?><span id="exCommunity" style=";padding: 2px;line-height: 25px;cursor: pointer;" attr-id="<?php echo ($communitys["id"]); ?>" ><?php echo ($communitys["community"]); ?></span><br><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>

					<!--书记特有的切换社区的按钮-->
				</div>



				<!-- 头部结束 -->

<hr size="5px">

				<!-- 内容开始 -->
				<div style="padding: 0px  0px 0px 60px;height: 360px;" class="courst-content">
					<div class="courst-content-item">
						<!-- 小区 -->
						<div class="content-item" onclick="javascript:location.href='/index.php?m=house&c=list&a=index' ">
							<div class="content-item-name">
								<span style="font-size: 14px;">房屋管理</span>
							</div>
							<div class="content-item-number">
								<span style="font-size: 14px;"><?php echo ($houseCount); ?>个</span>
							</div>
							<div class="content-item-operate">
								<a href="/index.php?m=house&c=add&a=index">添加房屋</a>&nbsp;&nbsp;导入房屋
							</div>
						</div>
						<!-- 房屋 -->
						<div style="position: relative" class="content-item" >
							<div onclick="javascript:location.href='/index.php?m=people&c=list&a=index' " class="content-item-name">
								<span style="font-size: 14px;">住户管理</span>
							</div>
							<div onclick="javascript:location.href='/index.php?m=people&c=list&a=index' " class="content-item-number">
								<span style="font-size: 14px;"><?php echo ($peopleCount); ?>个</span>
							</div>
							<div onclick="javascript:location.href='/index.php?m=people&c=list&a=index' " style="margin-top: 60px;margin-left:100px;height: 100%;width: 100%;font-size: 14px;color:#8C8C8C;">
								<!--常住人数：<?php echo ($peopleCount1); ?>个<br>-->
								<!--户籍人数：<?php echo ($peopleCount2); ?>个<br>-->
								<!--暂住人数：<?php echo ($peopleCount3); ?>个<br>-->
								<!--未驻入人数：<?php echo ($peopleCount4); ?>个<br>-->
							</div>
							<div class="content-item-operate">
								<a id="addPeopleBut">添加住户</a>&nbsp;&nbsp;导入住户
							</div>
							<div id="addPeopleMenu" style="width: 55px;padding: 8px;display: none;z-index:1000;background: #C8CDD2;color: #8C8C8C;line-height: 12px;font-size: 10px;position: absolute;top: -40px;left: 145px;" class="addPeople">
								<a style="padding:8px" href="/index.php?m=people&c=add&a=index">长住</a><br><hr style="margin: 3px;padding: 2px">
								<a style="padding: 8px;" href="/index.php?m=people&c=add&a=huji">户籍</a><br><hr style="margin: 3px;padding: 2px">
								<a style="padding: 8px;" href="/index.php?m=people&c=add&a=zanzhu">暂住</a><br><hr style="margin: 3px;padding: 2px">
								<a style="padding: 8px;" href="/index.php?m=people&c=add&a=weizhuru">未驻<a><br><hr style="margin: 3px;padding: 2px">
								<a style="padding: 8px;" href="/index.php?m=people&c=add&a=qiaolian">侨联<a><br>
							</div>
						</div>
						<!-- 车辆 -->
						<div class="content-item" onclick="javascript:location.href='/index.php?m=car&c=list&a=index' ">
							<div class="content-item-name">
								<span style="font-size: 14px;">车辆管理</span>
							</div>
							<div class="content-item-number">
								<span style="font-size: 14px;"><?php echo ($carCount); ?>个</span>
							</div>
							<div class="content-item-operate">
								<a href="/index.php?m=car&c=add&a=index">添加车辆</a>&nbsp;&nbsp;导入车辆
							</div>
						</div>
						<!-- 车辆 -->
						<div class="content-item" onclick="javascript:location.href='/index.php?m=lease&c=list&a=index'">
							<div class="content-item-name">
								<span style="font-size: 14px;">出租管理</span>
							</div>
							<div class="content-item-number">
								<span style="font-size: 14px;"><?php echo ($leaseCount); ?>个</span>
							</div>
							<div class="content-item-operate">
								<a href="/index.php?m=lease&c=add&a=index">添加出租</a>&nbsp;&nbsp;导入出租
							</div>
						</div>
						<!-- 商铺企业 -->
						<div class="content-item" onclick="javascript:location.href='/index.php?m=company&c=list&a=index'">
							<div class="content-item-name">
								<span style="font-size: 14px;">商铺管理</span>
							</div>
							<div class="content-item-number">
								<span style="font-size: 14px;"><?php echo ($companyCount); ?>个</span>
							</div>
							<div class="content-item-operate">
								<a href="/index.php?m=company&c=add&a=index">添加商铺</a>&nbsp;&nbsp;导入商铺
							</div>
						</div>
						<!-- 收费 -->
						<div class="content-item" onclick="javascript:location.href='/index.php?m=charge&c=list&a=index'">
							<div class="content-item-name">
								<span style="font-size: 14px;">收费管理</span>
							</div>
							<div class="content-item-number">
								<span style="font-size: 14px;"><?php echo ($chargeCount); ?>个</span>
							</div>
							<div class="content-item-operate">
								<a href="/index.php?m=charge&c=list&a=index">添加收费</a>&nbsp;&nbsp;导入收费
							</div>
						</div>

						<!-- 管理员事件 -->
						<?php if($_SESSION['admin']['isadmin']== 1): ?><div class="content-item" onclick="javascript:location.href='/index.php?m=task&c=list&a=verify'">
							<div class="content-item-name">
								<span style="font-size: 14px;">事件管理</span>
							</div>
							<div class="content-item-number">
								<span style="font-size: 14px;"><?php echo ($taskCount); ?>个</span>
							</div>
							<div class="content-item-operate">
								<a href="/index.php?m=task&c=add&a=index">添加事件</a>&nbsp;&nbsp;导入任务
							</div>
						</div>
							<?php else: ?>
							<!--社区干部-->
							<div class="content-item" onclick="javascript:location.href='/index.php?m=task&c=list&a=index'">
								<div class="content-item-name">
									<span style="font-size: 14px;">事件管理</span>
								</div>
								<div class="content-item-number">
									<span style="font-size: 14px;"><?php echo ($taskCount); ?>个</span>
								</div>
								<div class="content-item-operate">
									<a href="/index.php?m=task&c=add&a=index">添加事件</a>&nbsp;&nbsp;导入任务
								</div>
							</div><?php endif; ?>

						<?php if($_SESSION['admin']['isadmin']== 1): ?><!-- 管理员/书记特有的-->
						<div class="content-item" >
							<div class="content-item-name" onclick="javascript:location.href='/index.php?m=admin&c=list&a=index' ">
								<span style="font-size: 12px;">管理员/小区</span>
							</div>
							<div class="content-item-number"  id="communityShow">
								<span style="font-size: 12px;"><?php echo ($adminCount); ?>/<?php echo ($communityCount); ?>&nbsp;个</span>
							</div>
							<div class="content-item-operate">
								<a href="/index.php?m=admin&c=add&a=index">添加管理员</a>&nbsp;&nbsp;<a class="mouse-a" data-toggle="modal" data-target="#addCommunity">添加小区</a>
							</div>
						</div>
							<?php else: endif; ?>

					</div>
				</div>

				<!-- 内容结束 -->
				<!-- 页脚 -->
				<div class="courst-foot" style="margin-top: 80px;">
					<div class="foot-des">
						<p>&copy;weierlin | 2018</p>
					</div>
				</div>
				<!-- 页脚结束 -->	

		</div>
	</div>
</div>

<!-- <!-- 帮助（Modal） -->
			<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					</div>	
				</div>
			</div>
					<!--帮助结束-->


<!--文件操作-->
<div class="fileDiv" style="left: 85%">
	<div class="title">
		最新公告<span class="right" onclick="javascript:location.href='/index.php?m=admin&c=file&a=fileList'" style="cursor: pointer">|更多</span>
	</div>
	<div class="list" style="overflow: hidden">
		<?php if($fileCount <= 3): if(is_array($fileInfo)): $i = 0; $__LIST__ = $fileInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fileInfo): $mod = ($i % 2 );++$i;?><a href="/index.php?m=admin&c=file&a=fileDown&id=<?php echo ($fileInfo["id"]); ?>" ><?php echo ($fileInfo["filename"]); ?>...</a><br><?php endforeach; endif; else: echo "" ;endif; ?>
			<a target="_blank" href="/index.php?m=home&c=index&a=note" >关于本软件须知事项...</a><br>
			<a class="mouse-a" data-toggle="modal" data-target="#about" >关于我们...</a><br>
			<a href="mailto:1661590912@qq.com" >联系站长...</a><br><?php endif; ?>
	</div>
</div>

<!-- 左边菜单 -->
<div class="sidebar-menu" style="font-size: 14px;min-width: 14%;">
	    <div class="menu">
			<ul id="menu" >
				<li><a><span class="glyphicon glyphicon-asterisk"></span>&nbsp;<span>菜单管理</span></a></li>

				<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;<span>添加信息</span> <span class="fa fa-angle-right" style="float: right">&gt;</span></a>
					<ul id="menu-academico-sub" >
						<li><a href="./People/addPeople.html">添加人员</a></li>
						<li><a href="./Car/addCar.html">添加车辆</a></li>
						<li><a href="./House/addHouse.html">添加房屋</a></li>
						<li><a href="./Task/addTask.html">添加任务</a></li>
					</ul>
				</li>

				<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;<span> 人员</span> <span class="fa fa-angle-right" style="float: right">&gt;</span></a>
					<ul id="menu-academico-sub" >
						<li><a href="./People/peopleList.html">人员列表</a></li>
						<li><a href="./People/normalPeople.html">正常人员</a></li>
						<li><a href="./People/badPeople.html">严重人员</a></li>
					</ul>
				</li>

				<li><a href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<span> 房屋</span><span class="fa fa-angle-right" style="float: right">&gt;</span></a>
					<ul id="menu-academico-sub" >
						<li><a href="./House/houseList.html">房屋列表</a></li>
						<li><a href="#">出租房屋</a></li>
					</ul>
				</li>

				<li><a href="#"><span class="glyphicon glyphicon-plane"></span>&nbsp;<span>车辆</span><span class="fa fa-angle-right" style="float: right">&gt;</span></a>
					<ul id="menu-academico-sub" >
						<li><a href="./Car/carList.html">车辆列表</a></li>
					</ul>
				</li>

				<li><a href="#"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<span>任务</span><span class="fa fa-angle-right" style="float: right">&gt;</span></a>
					<ul id="menu-academico-sub" >
						<li><a href="./Task/taskList.html">任务列表</a></li>
						<li><a href="./Task/unread.html" class="mouse-a">未完成任务<span class="badge">50</span></a></li>
					</ul>
				</li>

			</div>

</div>
		</div>
	<div class="clearfix"></div>
	<!--  添加小区（Modal） -->
	<div class="modal fade" id="addCommunity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="margin-top: 20%;width: 400px;margin-right: 30%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel" style="text-align: center">
						添加小区
					</h4>
				</div>
				<div class="modal-body" style="text-align: center">
					<form>
						<input name="community" type="text" style="text-align: center;width: 100px;margin-right: 10px;" placeholder="请输入小区名字">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="addInfo.add()">确定
					</button>
				</div>
			</div>
		</div>
	</div>
	<!--收费结束-->
	<!--小区列表-->
	<div id="communityList" class="communityList" style="line-height: 30px;width: 100%;height: 100%;margin-top: 10px;text-align: center;display: none">
			<?php if(is_array($communityShow)): $i = 0; $__LIST__ = $communityShow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$communityShow): $mod = ($i % 2 );++$i;?>NO.<?php echo ($communityShow["id"]); ?>&nbsp;:&nbsp;<?php echo ($communityShow["community"]); ?>
				<span style="color: red;font-size: 14px;cursor: pointer" id="delCommunity" attr-id="<?php echo ($communityShow["id"]); ?>" class="glyphicon glyphicon-remove"></span><br><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>
							
<!-- Bootstrap Core JavaScript -->
<script src="/Template/js/bootstrap.min.js"></script>
<script src="/Public/js/dialog/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/home/exCommunity.js"></script>
<script src="/Public/js/home/addInfo.js"></script>
<script src="/Public/js/home/delCommunity.js"></script>

<script type="text/javascript">


	//显示小区的列表
	$('#communityShow').on('click',function () {
		layer.open({
			type: 1,
			title: '小区列表',
			closeBtn: 1,
			btn : ['确定'],
			area: ['360px', '240px'], //宽高
			content:$('#communityList'),
		});
	})

	// <!--定时向后台访问，看有没有未读或者未处理事件-->
	var num = Math.round(Math.random()*90+60);
	//循环执行，每隔60-150秒钟执行一次showMsgIcon()
	window.setInterval(taskTip, 500*num);
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

	//社区按钮
	$(function() {

		$(function () {
			$("#communityBut").click(function () {
				$("#communityMenu").toggle();
			});
		});
	});

	//添加人员按钮
	$(function() {

		$(function () {
			$("#addPeopleBut").click(function () {
				$("#addPeopleMenu").toggle();
			});
		});
	});
</script>

</body>
</html>