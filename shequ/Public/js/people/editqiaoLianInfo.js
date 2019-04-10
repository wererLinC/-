var editqiaoLianInfo={
    edit:function () {
        var data = $("#editQiaoLianInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        // 将获取到的数据post给服务器
        url = '/index.php?m=people&c=edit&a=editQiaoLian';
        $.post(url,postData,function(result) {
            if(result.status == 1) {
                layer.load(1, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                window.location.href="/index.php?m=people&c=list&a=qiaolian";
            }else if(result.status == 0) {
                // 失败
                return dialog.error(result.message);
            }
        },"JSON");
    },

}