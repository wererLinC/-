$('#del').on('click',function () {
    var id = $('#delId').val();
    postData = {
        'id': id,
    }
    // 将获取到的数据post给服务器
    jump_url = '/index.php?m=task&c=list&a=completed';
    url = '/index.php?m=task&c=del&a=index';
    layer.open({
        content: "确定删除",
        icon: 3,
        btn: ['是', '否'],
        yes: function () {
            $.post(url, postData, function (result) {
                if (result.status == 1) {
                    //成功
                    layer.load(1, {
                        shade: [0.1, '#fff'] //0.1透明度的白色背景
                    });
                    window.location.href = jump_url;
                } else if (result.status == 0) {
                    // 失败
                    return dialog.error(result.message);
                }
            }, "JSON");
        }
    })
})