// function change(obj,id) {
//     $.ajax({
//         type: 'POST',
//         url: 'http://localhost/CWP/service/admin.php/Home/Dynamic/change/id/'+id,
//         data: {'id': id},
//         success: function (response) {
//             if (response == 0) {
//                 console.log(response);
//             } else if (response == 1) {
//                 console.log(response);
//             }
//         },
//         error:function (response) {
//             console.log(response);
//         }
//     });
// }
function changeshows(obj,id){
    //confirm(id);
    //$(obj).toggleClass('layui-form-onswitch');
    $.ajax({
        type: 'POST',
        url: 'http://localhost/CWP/admin/admin.php/Home/Dynamic/changeshows',
        data: {
            'id': id,
        },
        success: function (data,status) {
            // console.log(data);
            if(data==0){
                $(obj).removeClass('layui-form layui-form-onswitch');
            }else if(data==1){
                $(obj).addClass('layui-form layui-form-onswitch');
            }
        }
    });
}
