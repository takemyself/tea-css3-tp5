$(function() {
    $('#file_upload').uploadify({
        'buttonText' : '请选择文件',
        'formData'     : {
            'timestamp' : '',
            'token'     : ''
        },
        'fileSizeLimit' : '500MB',
        'swf'      : "__ROOT__/public/uploadify/uploadify.swf",
        'uploader' : "{:url('uploads')}",
        'onUploadSuccess' : function(file, data, response) {
            var data=JSON.parse(data);
            if(data.valid==1){
                var str='<div class="images"><input name="tpic" type="hidden" value="'+data.msg+'"/><img src="__ROOT__/public/uploads/'+data.msg+'" width="150px" height="100px"><a href="javascript:;" class="btn btn-danger col-sm-offset-1 delimg">删除</a></div>';
                $('#dispathed').append(str);
            }else{
                alert('失败');
            }
        }
    });
    $('.form-group').on('click','.delimg',function () {
        var path=$(this).parents('.images').find('input').val();
        $.post("{:url('delimg')}",{path:path},function (res) {
        },'json');
        $(this).parents('.images').remove();
    })
});