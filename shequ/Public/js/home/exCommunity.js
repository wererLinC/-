$('.communityMenu #exCommunity').on('click',function () {
    var id = $(this).attr('attr-id');
    postData = {
        'id': id,
    };

    // 将获取到的数据post给服务器
    jump_url = '/index.php';
    url = '/index.php?m=home&c=index&a=exCommunity';
    layer.open({
        content: "是否更换社区？？",
        icon: 3,
        btn: ['是', '否'],
        yes: function () {
            $.post(url, postData, function (result) {
                if (result.status == 0) {
                    return dialog.error(result.message);
                }
                if (result.status == 1) {
                    layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });
                    window.location.href=jump_url;

                }
            }, 'JSON')

        }
    })
})


