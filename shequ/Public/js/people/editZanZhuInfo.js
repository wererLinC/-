var editZanZhuInfo={
    edit:function () {
        var data = $("#editZanZhuInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        // 将获取到的数据post给服务器
        //jump_url2 = '/index.php?m=people&c=list&a=index';
        url = '/index.php?m=people&c=edit&a=editZanZhu';
        $.post(url,postData,function(result) {
            if(result.status == 1) {
                //成功
                var id = postData['id'];
                layer.load(1, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                window.location.href="/index.php?m=people&c=information&a=zanzhu&id="+id;
            }else if(result.status == 0) {
                // 失败
                return dialog.error(result.message);
            }
        },"JSON");
    },

}