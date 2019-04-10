var searchEditCharge={
    edit:function () {
        $money = $('input[name="editMoney"]').val();
        $id = $('input[name="editId"]').val();
        // 传递参数到服务器端去
        var url = "/index.php?m=charge&c=edit&a=edit";
        data = {
            'id':$id,
            'money':$money,
        }
        $.post(url,data,function (result) {
            if(result.status == 0){
                return dialog.error(result.message);
            }if(result.status == 1){
                layer.load(1, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                window.location.reload();
            }
        },'JSON')

    }
}