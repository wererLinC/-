<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<title>出租管理</title>
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
				   <li><a href="/index.php?m=lease&c=list&a=index">出租管理</a></li>
				   
    <li class="active">出租修改</li>

			   </ol>
		   </div>
		   <!-- 面包屑结束 -->
				<!-- 头部结束 -->

<hr size="5px">

    <!-- 内容开始 -->
    <div class="courst-content">
        <div class="courst-content-item">
                <div class="addHouse-content">
                    <div style="height: 100%;width: 600px;margin: 0 auto;margin-top: 30px;">
                        <form role="form" id="editLeaseInfo" >
                            <!-- 手机验证 -->
                            <div class="form-group">
                                <div class="input-group  ">

                                    <span class="input-group-addon ">出租类型</span>
                                    <select name="leaseType" data-toggle="select" class="form-control select select-warning mrs">
                                        <?php if($leaseInfo["leasetype"] == 1): ?><option value="1" selected>个人</option><?php else: ?><option value="1" >个人</option><?php endif; ?>
                                        <?php if($leaseInfo["leasetype"] == 2): ?><option value="2" selected>单位</option><?php else: ?><option value="2" >单位</option><?php endif; ?>
                                    </select>

                                    <span class="input-group-addon ">出租用途</span>
                                    <select name="leaseUse" data-toggle="select" class="form-control select select-warning mrs">
                                        <?php if($leaseInfo["leaseuse"] == 1): ?><option value="1" selected>居住</option><?php else: ?><option value="1" >居住</option><?php endif; ?>
                                        <?php if($leaseInfo["leaseuse"] == 2): ?><option value="2" selected>办公</option><?php else: ?><option value="2" >办公</option><?php endif; ?>
                                        <?php if($leaseInfo["leaseuse"] == 3): ?><option value="3" selected>商业</option><?php else: ?><option value="3" >商业</option><?php endif; ?>
                                        <?php if($leaseInfo["leaseuse"] == 4): ?><option value="4" selected>其他</option><?php else: ?><option value="4" >其他</option><?php endif; ?>
                                    </select>

                                </div>

                            </div>

                            <!-- 手机验证 -->
                            <div class="form-group">
                                <div class="input-group  ">
                                    <span class="input-group-addon ">出租时间</span>
                                    <input  type="date" class="form-control"  name="startTime" placeholder="注册日期" value="<?php echo ($leaseInfo["starttime"]); ?>"/>
                                    <span class="input-group-addon ">到期时间</span>
                                    <input  type="date" class="form-control"  name="endTime" placeholder="注册日期" value="<?php echo ($leaseInfo["endtime"]); ?>"/>
                                </div>

                            </div>

                            <!-- 校验用 -->
                            <div class="form-group">
                                <div class="input-group  ">
                                    <span class="input-group-addon ">使用人姓名</span>
                                    <input type="text" class="form-control"  name="useName" value="<?php echo ($leaseInfo["usename"]); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group  ">
                                    <span class="input-group-addon ">使用人身份证</span>
                                    <input type="text" class="form-control"  name="useCardId" value="<?php echo ($leaseInfo["usecardid"]); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group  ">
                                    <span class="input-group-addon ">使用人电话</span>
                                    <input type="text" class="form-control"  name="usePhone" value="<?php echo ($leaseInfo["usephone"]); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group  ">
                                    <span class="input-group-addon ">使用单位</span>
                                    <input type="text" class="form-control"  name="userLand" value="<?php echo ($leaseInfo["useland"]); ?>">
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo ($leaseInfo["id"]); ?>">
                        </form>
                    </div>
                    <div class="addHouse-operate">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" style="margin-left: 140px;border-radius: 10%;" onclick="editInfo.edit()">确定</button>
                                            <button style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " onclick="javascript :history.back(-1);">返回</button>
                                        </span>
                    </div>
                    <!-- 显示房屋信息 -->
                    <div class="houseInfo-show" style="height: 300px;padding-left: 8px;">
                        <span style="font-weight: bold;">房屋地址&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo ($houseInfo["address"]); ?></span><br>
                        <span style="font-weight: bold;">小区名称&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo (getCommunity($houseInfo["community"])); ?></span><br>
                        <span style="font-weight: bold;">楼栋号&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo ($houseInfo["buildnum"]); ?></span><br>
                        <span style="font-weight: bold;">单元号&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo ($houseInfo["unitnum"]); ?></span><br>
                        <span style="font-weight: bold;">室号&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo ($houseInfo["roomnum"]); ?></span><br>
                        <span style="font-weight: bold;">房屋主姓名&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo ($houseInfo["name"]); ?></span><br>
                        <span style="font-weight: bold;">身份证号码&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo ($houseInfo["cardid"]); ?></span><br>
                        <span style="font-weight: bold;">联系电话&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo ($houseInfo["phone"]); ?></span><br>
                        <span style="font-weight: bold;">房屋类型&nbsp;:</span>&nbsp;&nbsp;<span style="font-size: 14px;"><?php echo (getRoomType($houseInfo["roomtype"])); ?></span><br>
                    </div>
                    <!-- 显示房屋信息结束 -->
                </div>
        </div>

    </div>
    <!-- 内容结束 -->

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

	
    <script src="/Public/js/lease/editInfo.js"></script>


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