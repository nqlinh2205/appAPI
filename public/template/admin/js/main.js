$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#form-delete').submit(function(){
    return confirm("Bạn muốn xoá");
})

// Upload ảnh

$('#upload_img').change(function(){
    const form = new FormData();
    form.append('file',$(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON' ,
        data: form,
        url: '/admin/upload/server',
        success: function(result){
            if(result.error == false){
                $('#image_show').html(
                    '<a href='+result.url+' target="_blank"> <img  width="100" src='+result.url+'></img> </a>'
                )

                $('#thumb').val(result.url)
            }else{
                alert('Upload file lỗi');
            }
        }
    })
})