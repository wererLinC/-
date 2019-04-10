var addInfo={
    add:function () {
        var data = $("#leaseInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        var startTime =postData['startTime'].substr(0,10);
        var endTime =postData['endTime'].substr(0,10);
        postData['startTime'] = startTime;
        postData['endTime'] = endTime;
        // 将获取到的数据post给服务器
        jump_url = '/index.php?m=lease&c=list&a=index';
        url = '/index.php?m=lease&c=add&a=add';
        $.post(url,postData,function(result) {
            if(result.status == 1) {
                //成功
                return dialog.success(result.message,jump_url);
            }else if(result.status == 0) {
                // 失败
                return dialog.error(result.message);
            }
        },"JSON");
    },

}