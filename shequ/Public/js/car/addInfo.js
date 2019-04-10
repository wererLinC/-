var addInfo={
    add:function () {
        var data = $("#carInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        // 将获取到的数据post给服务器
        jump_url = '/index.php?m=car&c=list&a=index';
        url = '/index.php?m=car&c=add&a=add';
        $.post(url,postData,function(result) {
            if(result.status == 1) {
                //成功
                return dialog.success('添加成功',jump_url);
            }else if(result.status == 0) {
                // 失败
                return dialog.error(result.message);
            }
        },"JSON");
    },

}