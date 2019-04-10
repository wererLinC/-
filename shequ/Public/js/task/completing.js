$('#completingBtn').on('click',function () {
    layer.open({
        type: 1,
        title: "处理结果",
        closeBtn: 1,
        btn : ['确定'],
        area: ['420px', '280px'], //宽高
        content:$('#completingDiv'),
        yes:function () {
            $eventResult = $('#eventResult').val();
            $id = $('#taskId').val();
            var data = {
                'id':$id,
                'eventResult':$eventResult
            }
            console.log(data);

            var url= "/index.php?m=task&c=operate&a=completing";
            $.post(url,data,function (result) {
                if(result.status == 0){
                    return dialog.error(result.message);
                }if(result.status == 1){
                    return dialog.success(result.message,"/index.php?m=task&c=list&a=completing");
                }
            },'JSON')


        }
    });

})