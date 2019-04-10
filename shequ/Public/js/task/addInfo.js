var addInfo={
    add:function () {
        var data = $("#eventInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        var myDate = new Date()
        myDate.getFullYear(); //获取完整的年份(4位,1970-????)
        myDate.getMonth(); //获取当前月份(0-11,0代表1月)
        myDate.getDate(); //获取当前日(1-31)
        var mytime=myDate.toLocaleString( ).substr(0,10);
        postData['startTime'] = mytime;
        // 将获取到的数据post给服务器
        jump_url = '/index.php?m=task&c=list&a=index';
        url = '/index.php?m=task&c=add&a=add';
        $.post(url,postData,function(result) {
            if(result.status == 1) {
                //成功
                return dialog.success(result.message,jump_url);
            }else if(result.status == 0) {
                // 失败
                return dialog.error(result.message);
            }
            else if(result.status == 2) {
                // 失败
                return dialog.success(result.message,'/index.php?m=task&c=list&a=verify');
            }
        },"JSON");
    },

}