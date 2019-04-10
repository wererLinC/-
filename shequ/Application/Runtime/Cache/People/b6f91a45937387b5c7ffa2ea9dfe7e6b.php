<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
<title>人员搜索列表</title></title>
<!-- Bootstrap Core CSS -->
<link href="/Template/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="/Template/css/style.css" rel='stylesheet' type='text/css' />
<link href="/Template/css/base.css" rel='stylesheet' type='text/css' />

    <link href="/Template/css/peopleList.css" rel='stylesheet' type='text/css' />

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
            <li class="active">搜索列表</li>
        </ol>
    </div>

<hr size="5px">
		   
    <div class="courst-content" style="height: 450px;">
        <?php if($peopleInfo != null): ?><div class="courst-content-item">
                <?php if(is_array($peopleInfo)): $i = 0; $__LIST__ = $peopleInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$peopleInfo): $mod = ($i % 2 );++$i;?><!-- 人员信息 -->
                    <div id="content-item" class="content-item qiaolianTable" style="width: 300px;">
                        <div id="content-item-name" class="content-item-name" style="width: 180px;" onclick="javascript:location.href='/index.php?m=people&c=information&a=qiaolian&id=<?php echo ($peopleInfo["id"]); ?>' ">
                            <span style="font-size: 12px;color: #888888">名字：<?php echo ($peopleInfo["name"]); ?></span><br>
                            <span style="font-size: 12px;color: #888888">户主名字:<?php echo ($peopleInfo["ownername"]); ?></span><br>
                            <span style="font-size: 12px;color: #888888">[与户主关系]:<?php echo (getRelative($peopleInfo["ownerrelative"])); ?></span>
                        </div>
                        <div id="content-item-number"  class="content-item-number" style="position:absolute;top: 8px;right: 5px" onclick="javascript:location.href='/index.php?m=people&c=information&a=qiaolian&id=<?php echo ($peopleInfo["id"]); ?>' ">
                            <span style="font-size: 12px;color: #888888">居住国家：<?php echo ($peopleInfo["country"]); ?></span><br>
                            <span style="font-size: 12px;color: #888888">类型:<?php echo (getQiaoLianType($peopleInfo["type"])); ?></span><br>
                        </div>
                        <input id="peopleId" type="hidden" value="<?php echo ($peopleInfo["id"]); ?>">
                        <div id="content-item-operate" class="content-item-operate">
                            <a href="/index.php?m=people&c=edit&a=qiaolian&id=<?php echo ($peopleInfo["id"]); ?>">修改资料</a>&nbsp;&nbsp;
                            <!--<a onclick="delQiaoLianInfo.del()">迁出</a>-->
                            <a id="delId" attr-id="<?php echo ($peopleInfo["id"]); ?>">迁出</a>
                        </div>
                    </div>
                    <!-- 人员信息结束 --><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php else: ?>
            <span style="color: red">娌℃湁鐩稿叧璁板綍</span><?php endif; ?>

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

	
    <script type="text/javascript">
        //迁出操作
        $('.qiaolianTable #delId').on('click',function () {
            var id = $(this).attr('attr-id');
            var postData = {
                'id':id,
            }
            layer.open({
                content : "确定迁出？？",
                icon:3,
                btn : ['是','否'],
                yes : function(){
                    url = '/index.php?m=people&c=del&a=qiaolian';
                    $.post(url,postData,function(result) {
                        if(result.status == 1) {
                            //成功
                            window.location.href='/index.php?m=people&c=list&a=qiaolian';
                        }else if(result.status == 0) {
                            // 失败
                            return dialog.error(result.message);
                        }
                    },"JSON");
                },
            });

        });        //添加函数
        $('#addpeople').on('click',function () {
            window.location.href='/index.php?m=people&c=add&a=qiaolian';
        });
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