var addCharge={
    add:function () {
        $money = $('input[name="money"]').val();
        $id = $('input[name="id"]').val();
        //获取当前时间
            var now = new Date();

            var year = now.getFullYear();       //年
            var month = now.getMonth() + 1;     //月
            var day = now.getDate();            //日

            var hh = now.getHours();            //时
            var mm = now.getMinutes();          //分
            var ss = now.getSeconds();           //秒

            var clock = year + "-";

            if(month < 10)
                clock += "0";
            clock += month + "-";
            if(day < 10)
                clock += "0";
            clock += day + " ";

        // 传递参数到服务器端去
        var url = "/index.php?m=charge&c=add&a=add";
        data = {
            'id':$id,
            'money':$money,
            'time':clock
        }
        $.post(url,data,function (result) {
            if(result.status == 0){
                return dialog.error(result.message);
            }if(result.status == 1){
                return dialog.success(result.message,'/index.php?m=charge&c=list&a=index');
            }
        },'JSON')

    }
}