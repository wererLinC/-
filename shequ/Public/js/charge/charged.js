$('.chargeTable #conformCharge').on('click',function () {
    // $id = $('#chargeId1').val();
    var id = $(this).attr('attr-id');
    data = {
        'id':id
    }
    layer.open({
        content : "确定收费？？",
        icon:3,
        btn : ['是','否'],
        yes : function(){
            url = '/index.php?m=charge&c=add&a=conform';
            $.post(url,data,function(result) {
                if(result.status == 1) {
                    //成功
                    window.location.href='/index.php?m=charge&c=list&a=unCharge';
                }else if(result.status == 0) {
                    // 失败
                    return dialog.error(result.message);
                }
            },"JSON");
        },
    });
})
