$('#verify').on('click',function () {
    var id = $('#verifyId').val();
    postData = {
        'id': id,
    }
    var myDate = new Date()
    myDate.getFullYear(); //获取完整的年份(4位,1970-????)
    myDate.getMonth(); //获取当前月份(0-11,0代表1月)
    myDate.getDate(); //获取当前日(1-31)
    var mytime=myDate.toLocaleString( ).substr(0,10);
    postData['endTime'] = mytime;
    // 将获取到的数据post给服务器
    jump_url = '/index.php?m=task&c=list&a=verify';
    url = '/index.php?m=task&c=operate&a=verify';
    layer.open({
        content: "确定审核",
        icon: 3,
        btn: ['是', '否'],
        yes: function () {
            $.post(url, postData, function (result) {
                if (result.status == 1) {
                    //成功
                    return dialog.success(result.message, jump_url);
                } else if (result.status == 0) {
                    // 失败
                    return dialog.error(result.message);
                }
            }, "JSON");
        }
    })
})