$('#receiveBut').on('click',function () {
    var id = $('#receiveId').val();
    postData={
        'id':id,
    }
    // 将获取到的数据post给服务器
    jump_url = '/index.php?m=task&c=list&a=index';
    url = '/index.php?m=task&c=operate&a=receive';
    $.post(url,postData,function(result) {
        if(result.status == 1) {
            //成功
            return dialog.success(result.message,jump_url);
        }else if(result.status == 0) {
            // 失败
            return dialog.error(result.message);
        }
    },"JSON");
})