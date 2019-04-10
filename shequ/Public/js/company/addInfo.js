var addInfo={
    add:function () {
        var data = $("#companyInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        var regData =postData['regData'].substr(0,10);
        postData['regData'] = regData;
        // 将获取到的数据post给服务器
        jump_url = '/index.php?m=company&c=list&a=index';
        url = '/index.php?m=company&c=add&a=add';
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