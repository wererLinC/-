var addInfo={
    add:function () {
        $community = $('input[name="community"]').val();

        // 传递参数到服务器端去
        var url = "/index.php?m=admin&c=add&a=community";
        data = {
            'community':$community,
        }
        $.post(url,data,function (result) {
            if(result.status == 0){
                return dialog.error(result.message);
            }if(result.status == 1){
                layer.load(1, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                window.location.href='/index.php?m=home&c=index&a=index';
            }
        },'JSON')

    }
}