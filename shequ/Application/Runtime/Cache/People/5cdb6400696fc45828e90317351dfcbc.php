<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<title>人员管理</title>
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
            <li><a href="/index.php?m=people&c=list&a=index">人员管理</a></li>
            <li class="active">暂住人员添加</li>
        </ol>
    </div>

<hr size="5px">
		   
    <!-- 内容开始 -->
    <div class="courst-content" style="padding: 10px;height: 450px;">
        <div class="courst-content-item">
            <div class="addHouse-content">
                <div style="height: 100%;width: 600px;margin: 0 auto;margin-top: 30px;">
                    <form role="form" id="editZanZhuInfo" >
                        <!-- 手机验证 -->
                        <input type="hidden" name="community" value="<?php echo ($_SESSION['admin']['community']); ?>">
                        <input type="hidden" name="roomType" value="3">
                        <input type="hidden" name="id" value="<?php echo ($peopleInfo["id"]); ?>">
                        <div class="form-group">
                            <div class="input-group  ">
                                <span style="font-size: 10px;" class="input-group-addon ">楼栋号</span></span>
                                <input style="font-size: 10px;"  style="width: 82px;"  type="text" class="form-control"  name="buildNum" value="<?php echo ($peopleInfo["buildnum"]); ?>">

                                <span style="font-size: 10px;" class="input-group-addon ">单元号</span></span>
                                <input  style="font-size: 10px;width: 82px;"  type="text" class="form-control"  name="unitNum" value="<?php echo ($peopleInfo["unitnum"]); ?>">

                                <span style="font-size: 10px;" class="input-group-addon ">室号</span>
                                <input style="font-size: 10px;width: 82px;"  type="text" class="form-control"  name="roomNum" value="<?php echo ($peopleInfo["roomnum"]); ?>">
                                <span style="font-size: 10px;" class="input-group-btn">
                                <botton   class="btn btn-default" style="width: 140px;"    id="getHouseInfoButton" ><span>获取房屋信息</span></botton>
                            </span>
                            </div>

                        </div>

                        <input type="hidden" name="roomType" value="3">

                        <div class="form-group">
                            <div class="input-group  ">
                                <span style="font-size: 10px;" class="input-group-addon ">身份证号码</span>
                                <input style="font-size: 10px;" type="text" class="form-control"  name="cardId" value="<?php echo ($peopleInfo["cardid"]); ?>">
                            </div>
                        </div>

                        <!-- 校验用 -->
                        <div class="form-group">
                            <div class="input-group  ">
                                <span style="font-size: 10px;" class="input-group-addon ">姓名</span>
                                <input style="font-size: 10px;" type="text" class="form-control"  name="name" value="<?php echo ($peopleInfo["name"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group  ">
                                <span style="font-size: 10px;" class="input-group-addon ">电话</span>
                                <input style="font-size: 10px;" type="text" class="form-control"  name="phone" value="<?php echo ($peopleInfo["phone"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group  ">
                                <span style="font-size: 10px;" class="input-group-addon ">工作单位</span>
                                <input style="font-size: 10px;" type="text" class="form-control"  name="workLand" value="<?php echo ($peopleInfo["workland"]); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group  ">
                                <span style="font-size: 10px;" class="input-group-addon ">户籍地</span>
                                <input style="font-size: 10px;" type="text" class="form-control"  name="birthLand" value="<?php echo ($peopleInfo["birthland"]); ?>">
                            </div>
                        </div>
                        <!-- 手机验证 -->
                        <div class="form-group">
                            <div class="input-group  ">

                                <span style="font-size: 10px;" class="input-group-addon ">职务</span>
                                <select style="font-size: 10px;" name="position" data-toggle="select" class="form-control select select-warning mrs">
                                    <?php if($peopleInfo["policy"] == 1): ?><option value="1" selected>楼栋长</option><?php else: ?><option value="1">楼栋长</option><?php endif; ?>
                                    <?php if($peopleInfo["policy"] == 2): ?><option value="2" selected>小组长</option><?php else: ?><option value="2">小组长</option><?php endif; ?>
                                    <?php if($peopleInfo["policy"] == 3): ?><option value="3" selected>志愿者</option><?php else: ?><option value="3">志愿者</option><?php endif; ?>
                                    <?php if($peopleInfo["policy"] == 4): ?><option value="4" selected>信息员</option><?php else: ?><option value="4">信息员</option><?php endif; ?>
                                </select>

                                <span style="font-size: 10px;" class="input-group-addon ">政治面貌</span>
                                <select style="font-size: 10px;" name="policy" data-toggle="select" class="form-control select select-warning mrs">
                                    <?php if($peopleInfo["policy"] == 1): ?><option value="1" selected>中共党员</option><?php else: ?><option value="1">中共党员</option><?php endif; ?>
                                    <?php if($peopleInfo["policy"] == 2): ?><option value="2" selected>共青团员</option><?php else: ?><option value="2">共青团员</option><?php endif; ?>
                                    <?php if($peopleInfo["policy"] == 3): ?><option value="3" selected>群众</option><?php else: ?><option value="3">群众</option><?php endif; ?>
                                    <?php if($peopleInfo["policy"] == 4): ?><option value="4" selected>预备党员</option><?php else: ?><option value="4">预备党员</option><?php endif; ?>
                                    <?php if($peopleInfo["policy"] == 5): ?><option value="5" selected>其他民主党派</option><?php else: ?><option value="5">其他民主党派</option><?php endif; ?>
                                </select>

                            </div>

                        </div>

                    </form>
                </div>
                <div class="addHouse-operate" style="bottom: -85px;">
								<span class="input-group-btn">
									<button class="btn btn-success" style="margin-left: 140px;border-radius: 10%;" onclick="editZanZhuInfo.edit()">确定</button>
									<button style="margin-left: 30px;border-radius: 10%;" class="btn btn-success " onclick="javascript :history.back(-1);">返回</button>
								</span>
                </div>
            </div>
        </div>

    </div>

    <!--弹出层-->
    <div id="tanchu" style="line-height: 30px;width: 100%;height: 100%;padding-left: 88px;text-align: left;display: none">
        <span id="communityOne">小区：<?php echo (getCommunity($_SESSION['admin']['community'])); ?></span>&nbsp;&nbsp;&nbsp;<span id="addressOne">地址：</span><br>
        &nbsp;<span id="buildNumOne">楼栋号：</span>&nbsp;<span id="unitNumOne">单元号：</span>&nbsp;<span id="roomNumOne">室号：</span><br>
        <span id="cardId">身份证号码：</span><br>
        <span id="nameOne">姓名：</span><br>
        <span id="phoneOne">电话：</span><br>

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
	<script src="/Template/js/jquery.min.js"></script>
   	<script src="/Template/js/bootstrap.min.js"></script>
	<script src="/Public/js/dialog.js"></script>
	<script src="/Public/js/dialog/layer.js"></script>

	
    <script src="/Public/js/people/editZanZhuInfo.js"></script>
    <script type="text/javascript">
        $('#getHouseInfoButton').on('click',function () {
            $buildNum = $('input[name="buildNum"]').val();
            $unitNum = $('input[name="unitNum"]').val();
            $roomNum = $('input[name="roomNum"]').val();
            data = {
                'buildNum':$buildNum,
                'unitNum':$unitNum,
                'roomNum':$roomNum,
            }
            var url= "/index.php?m=people&c=add&a=getInfo";
            $.post(url,data,function (result) {
                if(result.status == 0){
                    return dialog.error(result.message);
                }if(result.status == 1){
                    $('#addressOne').after(result.data.address);
                    $('#buildNumOne').after(result.data.buildnum);
                    $('#unitNumOne').after(result.data.unitnum);
                    $('#roomNumOne').after(result.data.roomnum);
                    $('#cardId').after(result.data.cardid);
                    $('#nameOne').after(result.data.name);
                    $('#phoneOne').after(result.data.phone);

                    return layer.open({
                        type: 1,
                        title: result.message,
                        closeBtn: 1,
                        btn : ['确定'],
                        area: ['480px', '280px'], //宽高
                        content:$('#tanchu'),
                    });

                }
            },'JSON')
        })
    </script>

	<!--导航条-->
	<script>
		$(document).ready(function(){

			$("#nav > li a").each(function(){
				$this = $(this).parents('#nav > li');
				if(this.href==window.location.href){
					$this.addClass("active");
				}
			});
		});
		// var nav = document.getElementById('nav');
		// var lis = nav.getElementsByTagName('li');
		// var length=lis.length;
		// for(i=0;i<length;i++) {
		// 	lis[i].onclick = function () {
		// 		for (j = 0; j < length; j++) {
		// 			lis[j].className = "";
		// 		}
		// 		this.className += "active";
		// 	}
		// }

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