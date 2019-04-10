$('.communityList #delCommunity').on('click',function () {
    var id = $(this).attr('attr-id');
    var url = "/index.php?m=admin&c=del&a=community";
    data = {
        'id':id,
    }
    layer.open({
        content: "确定删除？？",
        icon: 3,
        btn: ['是', '否'],
        yes: function () {
            $.post(url, data, function (result) {
                if (result.status == 0) {
                    return dialog.error(result.message);
                }
                if (result.status == 1) {
                    layer.load(1, {
                        shade: [0.1, '#fff'] //0.1透明度的白色背景
                    });
                    window.location.href = '/index.php?m=home&c=index&a=index';
                }
            }, 'JSON')
        }
    });
});