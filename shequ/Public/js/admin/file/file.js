$(function () {

    $('#uploadfile').fileinput({
        language: 'zh', //设置语言
        showUpload: true, //是否显示上传按钮
        showRemove:false,        showPreview:true,//是否显示预览
        uploadUrl: '/index.php?m=admin&c=file&a=fileUpload',  //上传地址
    }).on("filebatchselected", function(event, files) {
        $(this).fileinput("upload");
    }).on('filebatchuploadsuccess', function(even,data, previewId, index) {//上传成功从服务器端返回的数据（即保存的文件名称）
        $("#file_upload").attr('value','/Uploads/file/'+data['response']);
        $("#fileName").attr('value',data['response']);
        $name = data['response'];
        $('#fileNameShow').after("<span style='font-weight: bold;color:#F7B52C;position: absolute;top: 60px'>"+$name+"</span>"
    );
        if(data['response'] == null){

        }
    })

});

