var addHouseInfo={
    add:function () {
        var data = $("#houseInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        // 将获取到的数据post给服务器
       // jump_url1 = '/index.php?m=house&c=add&a=index';
        jump_url2 = '/index.php?m=house&c=list&a=index';
        url = '/index.php?m=house&c=add&a=add';
        $.post(url,postData,function (result) {
            if(result.status == 0){
                return dialog.error(result.message);
            }if(result.status == 1){
                return dialog.success(result.message,jump_url2);
            }
        },'JSON')

    },

};