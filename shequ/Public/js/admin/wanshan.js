$('#wanshan').on('click',function () {
    $picture = $('input[name="picture"]').val();
    $id = $('input[name="id"]').val();

    // 传递参数到服务器端去
    var url = "/index.php?m=admin&c=edit&a=wanshan1";
    data = {
        'picture':$picture,
        'id':$id
    }
    $.post(url,data,function (result) {
        if(result.status == 0){
            return dialog.error(result.message);
        }if(result.status == 1){
            return dialog.success(result.message,'/index.php?m=home&c=login&a=index');
        }
    },'JSON')
})




