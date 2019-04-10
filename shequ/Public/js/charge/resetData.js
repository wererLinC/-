var resetData={
    reset:function () {
        var data={
            'content':'重置'
        }
        layer.open({
            content : "确定重置？？",
            icon:3,
            btn : ['是','否'],
            yes : function(){
                url = '/index.php?m=charge&c=edit&a=resetData';
                $.post(url,data,function(result) {
                    if(result.status == 1) {
                        //成功
                        window.location.href='/index.php?m=charge&c=list&a=index';
                    }else if(result.status == 0) {
                        // 失败
                        return dialog.error(result.message);
                    }
                },"JSON");
            },
        });
    }
}