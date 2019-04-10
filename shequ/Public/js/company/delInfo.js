var delInfo={
    del:function () {
        $id = $('#companyId').val();
        var postData = {
            'id':$id,
        }
        layer.open({
            content : "确定删除？？",
            icon:3,
            btn : ['是','否'],
            yes : function(){
                url = '/index.php?m=company&c=del&a=del';
                $.post(url,postData,function(result) {
                    if(result.status == 1) {
                        //成功
                        window.location.href='/index.php?m=company&c=list&a=index';
                    }else if(result.status == 0) {
                        // 失败
                        return dialog.error(result.message);
                    }
                },"JSON");
            },
        });

        },

};