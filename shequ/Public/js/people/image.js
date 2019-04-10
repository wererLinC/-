$(function () {

    $('#uploadfile').fileinput({
        language: 'zh', //设置语言
        showUpload: true, //是否显示上传按钮
        showRemove:false,
        uploadUrl: '/index.php?m=people&c=add&a=img',  //上传地址
    }).on("filebatchselected", function(event, files) {
        $(this).fileinput("upload");
    }).on('filebatchuploadsuccess', function(even,data, previewId, index) {//上传成功从服务器端返回的数据（即保存的文件名称）
        $("#file_upload").attr('value','./Uploads'+data['response']);
        $("#img_show").show();
        $("#img_show").attr('src','./Uploads'+data['response']);
        // console.log(data['response']);
        if(data['response'] == null){

        }
    })

});

