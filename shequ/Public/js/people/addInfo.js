var addInfo={
    add:function () {
        var data = $("#peopleInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        // 将获取到的数据post给服务器
        jump_url = '/index.php?m=people&c=list&a=index';
        //jump_url2 = '/index.php?m=people&c=list&a=index';
        url = '/index.php?m=people&c=add&a=add';
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