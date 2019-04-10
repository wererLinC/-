var login={
    check:function () {
        $name = $('input[name="name"]').val();
        $cardId = $('input[name="cardId"]').val();

        // 传递参数到服务器端去
        var url = "/index.php?m=home&c=login&a=check";
        data = {
            'name':$name,
            'cardId':$cardId
        }
        $.post(url,data,function (result) {
            if(result.status == 0){
                return dialog.error(result.message);
            }if(result.status == 1){
                return dialog.success(result.message,'/index.php?m=home&c=index&a=index');
            }
        },'JSON')

    }
}