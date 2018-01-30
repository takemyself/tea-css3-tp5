$(function () {
    var urlDetail=window.location.host;
    //上传路径
    var uploadsUrl=urlDetail+'/admin/news/uploads';
    //上传图片---单图
    $('#file_upload').uploadify({
        'buttonText' : '请选择图片',
        'formData'     : {
            'timestamp' : '',
            'token'     : ''
        },
        'fileSizeLimit' : '500MB',
        'swf'      : "/public/uploadify/uploadify.swf",
        'uploader' : "/admin/news/uploads",
        'onUploadSuccess' : function(file, data, response) {
            var data=JSON.parse(data);
            if(data.valid==1){
                var str='<div class="images"><input name="npic" type="hidden" value="'+data.msg+'"/><img src="'+'/public/uploads/'+data.msg+'" width="150px" height="100px"><a href="javascript:;" class="btn btn-danger col-sm-offset-1 delimg">删除</a></div>';
                $('#dispathed').append(str);
            }else{
                alert('失败');
            }
        }
    });
     //删除图片
    $('.panel-body').on('click','.delimg',function () {
        var path=$(this).parents('.images').find('input').val();
        var ourl='/admin/news/delimg';
        $.post(ourl,{path:path},function (res) {
        },'json');
        $(this).parents('.images').remove();
    });
});