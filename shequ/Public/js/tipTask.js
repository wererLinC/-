var num = Math.round(Math.random()*90+60);
//循环执行，每隔60-150秒钟执行一次showMsgIcon()
window.setInterval(taskTip, 5000*num);
function taskTip(){
    $isAdmin = $('#isAdmin').val();
    postData={
        'isAdmin':$isAdmin,
    }
    url = '/index.php?m=home&c=index&a=task';
    $.post(url,postData,function (result) {
        if(result.status == 0){

        }else if(result.status == 1){
            layer.open({
                content : result.message,
                icon : 1,
                yes : function(){
                    clearInterval(taskTip);
                    location.href='/index.php?m=task&c=list&a=index';
                },
            });
        }else if(result.status == 2){
            layer.open({
                content : result.message,
                icon : 1,
                yes : function(){
                    clearInterval(taskTip);
                    location.href='/index.php?m=task&c=list&a=completing';
                },
            });
        }
        else if(result.status == 3){
            layer.open({
                content : result.message,
                icon : 1,
                yes : function(){
                    clearInterval(taskTip);
                    location.href='/index.php?m=task&c=list&a=verify';
                },
            });
        }
    },"JSON");
}