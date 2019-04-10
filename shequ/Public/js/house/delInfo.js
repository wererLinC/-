var delInfo={
    del:function () {
        $id = $('#houseId').val();
        var postData = {
            'id':$id,
        }
        layer.open({
            content : "确定删除？？",
            icon:3,
            btn : ['是','否'],
            yes : function(){
                jump_url = '/index.php?m=house&c=list&a=index';
                url = '/index.php?m=house&c=del&a=del';
                $.post(url,postData,function(result) {
                    if(result.status == 1) {
                        //成功
                        layer.load(1, {
                            shade: [0.1, '#fff'] //0.1透明度的白色背景
                        });
                        window.location.href = '/index.php?m=house&c=list&a=index';
                    }else if(result.status == 0) {
                        // 失败
                        return dialog.error(result.message);
                    }
                },"JSON");
            },
        });

        },

};