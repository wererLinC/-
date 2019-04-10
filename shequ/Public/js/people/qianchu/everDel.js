var everDel={
    del:function () {
        $id = $('#peopleId').val();
        var postData = {
            'id':$id,
        }
        layer.open({
            content : "确定永久删除？？",
            icon:3,
            btn : ['是','否'],
            yes : function(){
                url = '/index.php?m=people&c=del&a=everDel';
                $.post(url,postData,function(result) {
                    if(result.status == 1) {
                        //成功
                        window.location.href='/index.php?m=people&c=list&a=qianchu';
                    }else if(result.status == 0) {
                        // 失败
                        return dialog.error(result.message);
                    }
                },"JSON");
            },
        });

        },

};