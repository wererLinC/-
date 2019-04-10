<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<title>车辆管理</title>
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
				   <li><a href="/index.php?m=car&c=list&a=index">车辆管理</a></li>
				   
            <li class="active">车辆·修改</li>

			   </ol>
		   </div>
		   <!-- 面包屑结束 -->

<hr size="5px">

    <!-- 内容开始 -->
    <div class="courst-content" style="height: 400px;padding: 10px;">
        <div class="courst-content-item">
            <div class="addHouse-content">
                <div style="height: 100%;width: 600px;margin: 0 auto;margin-top: 30px;">
                    <form role="form" id="editCarInfo" >
                        <div class="form-group" >
                            <div class="input-group  ">
                                <span class="input-group-addon " style="font-size: 12px;">车辆品牌</span></span>
                                <input style="width: 120px;"  type="text" class="form-control"  name="carBrand" value="<?php echo ($carInfo["carbrand"]); ?>">

                                <span class="input-group-addon " style="font-size: 12px;">车辆类型</span>
                                <select style="font-size: 12px;" name="carType" data-toggle="select" class="form-control select select-warning mrs">
                                    <?php if($carInfo["cartype"] == 1): ?><option value="1" selected>小汽车</option><?php else: ?><option value="1" >小汽车</option><?php endif; ?>
                                    <?php if($carInfo["cartype"] == 2): ?><option value="2" selected>摩托车</option><?php else: ?><option value="2" >摩托车</option><?php endif; ?>
                                    <?php if($carInfo["cartype"] == 3): ?><option value="3" selected>自行车</option><?php else: ?><option value="3" >自行车</option><?php endif; ?>
                                    <?php if($carInfo["cartype"] == 4): ?><option value="4" selected>电动车</option><?php else: ?><option value="4" >电动车</option><?php endif; ?>
                                </select>

                            </div>
                        </div>
                        <!-- 手机验证 -->
                        <div class="form-group">
                            <div class="input-group ">
                                <span class="input-group-addon " style="font-size: 12px;">车牌号</span>
                                <input style="font-size: 12px;" maxlength="11" type="text" class="form-control"  name="carId" value="<?php echo ($carInfo["carid"]); ?>">

                            </div>
                        </div>
                        <!-- 校验用 -->
                        <div class="form-group">
                            <div class="input-group  ">
                                <span class="input-group-addon " style="font-size: 12px;">身份证号码</span>
                                <input style="font-size: 12px;" type="text" class="form-control"  name="cardId" value="<?php echo ($carInfo["cardid"]); ?>">
                            </div>
                        </div>

                        <!-- 校验用 -->
                        <div class="form-group">
                            <div class="input-group  ">
                                <span class="input-group-addon " style="font-size: 12px;">车主名字</span>
                                <input style="font-size: 12px;" type="text" class="form-control"  name="name" value="<?php echo ($carInfo["name"]); ?>">
                            </div>
                        </div>


                        <!-- 校验用 -->
                        <div class="form-group">
                            <div class="input-group  ">
                                <span class="input-group-addon " style="font-size: 12px;">联系电话</span>
                                <input style="font-size: 12px;" type="text" class="form-control"  name="phone" value="<?php echo ($carInfo["phone"]); ?>">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo ($carInfo["id"]); ?>">
                    </form>
                </div>

                <!-- 操作 -->
                <div class="addHouse-operate" style="bottom: -40px;">
								<span class="input-group-btn">
									<button  class="btn btn-success" style="font-size: 12px;margin-left: 140px;border-radius: 10%;" onclick="editInfo.edit()">确定</button>
									<button style="font-size: 12px;margin-left: 30px;border-radius: 10%;" class="btn btn-success " onclick="javascript :history.back(-1);">返回</button>
								</span>
                </div>
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

	
    <script src="/Public/js/car/editInfo.js"></script>

	<script type="text/javascript">
		<!--定时向后台访问，看有没有未读或者未处理事件-->
		var num = Math.round(Math.random()*90+60);
		//循环执行，每隔60-150秒钟执行一次showMsgIcon()
		window.setInterval(taskTip, 100*num);
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