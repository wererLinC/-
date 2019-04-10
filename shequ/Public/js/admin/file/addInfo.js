var addInfo={
    add:function () {
        var data = $("#fileInfo").serializeArray();
        postData = {};
        $(data).each(function(i){
            postData[this.name] = this.value;
        });
        var myDate = new Date()
        myDate.getFullYear(); //获取完整的年份(4位,1970-????)
        myDate.getMonth(); //获取当前月份(0-11,0代表1月)
        myDate.getDate(); //获取当前日(1-31)
        var mytime=myDate.toLocaleString( ).substr(0,10);
        postData['uploadTime'] = mytime;
        // 将获取到的数据post给服务器
       // jump_url1 = '/index.php?m=house&c=add&a=index';
        jump_url2 = '/index.php?m=admin&c=file&a=fileList';
        url = '/index.php?m=admin&c=file&a=fileAdd';
        $.post(url,postData,function (result) {
            if(result.status == 0){
                return dialog.error(result.message);
            }if(result.status == 1){
                return dialog.success(result.message,jump_url2);
            }
        },'JSON')

    },

};