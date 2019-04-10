var editInfo={
    edit:function () {
        var data = $("#editHouseInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        // 将获取到的数据post给服务器
        url = '/index.php?m=house&c=edit&a=edit';
        $.ajax({
            url:url ,
            type: "POST",
            data:postData,
            cache:false,
            dataType: "json",
            success: function(result){
                var id = postData['id'];
                layer.load(1, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                window.location.href="/index.php?m=house&c=information&a=index&id="+id;
            },
            error:function(err){
                return dialog.error("修改失败");
            }
        });

    },
};