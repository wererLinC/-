<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<title>车辆管理</title></title>
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
				   
            <li class="active">车辆列表</li>

			   </ol>
		   </div>
		   <!-- 面包屑结束 -->

<hr size="5px">

    <!-- 内容 -->
    <div class="courst-content" style="font-size: 12px;height: 580px;padding: 10px;">

        <div class="courst-contenr-border">
            <!-- 操作 -->
            <div class="courst-operate"  >
                <div class="operate-item">
									<span class="input-group-btn">
										<button  id="addCar" class="btn btn-success" style="border-radius: 10%;font-size: 12px">+&nbsp;添加</button>
										<button  id="addExcel" style="margin-left: 30px;border-radius: 10%;font-size: 12px" class="btn btn-success ">导入</button>
									</span>
                </div>
                <div class="operate-search">
                    <div class="header-search" style="font-size: 12px">
                        <div class="input-group col-md-8" >
                            <input style="font-size: 12px;height: 31px;" type="text" name="searchContent" class="form-control"placeholder="请输入字段名" / >
                            <span class="input-group-btn">
                                <button class="btn btn-primary" style="font-size: 12px;" id="searchButton">查找</button>
                            </span>
                        </div>
                    </div>
                    <span style="margin-bottom: 0px;color: #d58512;float: right;margin-right: 10px;">共：<?php if($count != null): echo ($count); else: ?>0<?php endif; ?>&nbsp;人</span>
                </div>
            </div>
            <!-- 操作结束 -->
            <table class="table-position table  table-bordered table-hover" style="width: 100%;margin: 0 auto; ">
                <tbody style="background-color: #FBFCFC;text-align: center;">
                <tr>
                    <th style="text-align: center;">身份证号码</th>
                    <th style="text-align: center;">姓名</th>
                    <th style="text-align: center;">联系电话</th>
                    <th style="text-align: center;">车辆品牌</th>
                    <th style="text-align: center;">车牌号码</th>
                    <th style="text-align: center;">车辆类型</th>
                </tr>
                <?php if(is_array($carInfo)): $i = 0; $__LIST__ = $carInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$carInfo): $mod = ($i % 2 );++$i;?><tr style="font-size: 12px;color: #8C8C8C;cursor: pointer;" onclick="javascript:location.href='/index.php?m=car&c=information&a=index&id=<?php echo ($carInfo["id"]); ?>'">
                        <td><?php echo ($carInfo["cardid"]); ?></td>
                        <td><?php echo ($carInfo["name"]); ?></td>
                        <td><?php echo ($carInfo["phone"]); ?></td>
                        <td><?php echo ($carInfo["carbrand"]); ?></td>
                        <td><?php echo ($carInfo["carid"]); ?></td>
                        <td><?php echo (getCarType($carInfo["cartype"])); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr  style="text-align: center;">
                    <td colspan="8">
                        <ul class="pagination" >
                            <?php echo ($pageRes); ?>
                        </ul>
                    </td>
                </tr>


                </tbody>
            </table>
        </div>
    </div>
    <!-- 内容结束 -->

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

	
    <script type="text/javascript">
        //添加函数
        $('#addCar').on('click',function () {
            window.location.href='/index.php?m=car&c=add&a=index';
        });

        //添加excel函数
        $('#addExcel').on('click',function () {
            window.location.href='/index.php?m=car&c=add&a=excel';
        });

        //搜索函数
        $('#searchButton').on('click',function () {
            var searchContent = $('input[name="searchContent"]').val();
            var re = /^[0-9]+.?[0-9]*$/; //判断字符串是否为数字 //判断正整数 /^[1-9]+[0-9]*]*$/
            if (re.test(searchContent)) {
                //是数字就是用身份证来查的
                window.location.href='/index.php?m=car&c=search&a=index&cardId='+searchContent;
            }else if(/^[\u4e00-\u9fa5]+$/i.test(searchContent)){
                //全是文字就按名字来查
                window.location.href='/index.php?m=car&c=search&a=index&name='+searchContent;
            }else{
                //既有文字也有字母按照车牌来查
                window.location.href='/index.php?m=car&c=search&a=index&carId='+searchContent;
            }
        })
    </script>

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