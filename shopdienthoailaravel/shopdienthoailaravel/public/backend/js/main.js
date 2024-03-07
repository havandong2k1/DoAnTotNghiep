// Delivery










// $(document).ready(function(){
//     $('.choose').on('change',function(){
//         var action = $(this).attr('id');
//         var ma_id = $(this).val();
//         var _token = $('input[name="_token"]').val();
//         var result = '';

//         if (action == 'city') {
//             result = 'province';
//         } else {
//             result = 'wards';
//         }
//         console.log("Action: " + action);
//         console.log("ma_id: " + ma_id);
//         console.log("_token: " + _token);

//         $.ajax({
//             url: '{{URL::to('/select-delivery')}}',
//             method: 'POST',
//             data: {
//                 action: action,
//                 ma_id: ma_id,
//                 _token: _token
//             },
//             success:function(data){
//                 console.log("Response data: " + data);
//                 $('#'+result).html(data);
//             },
//             error:function(jqXHR, textStatus, errorThrown){
//                 console.log("AJAX Error: " + textStatus, errorThrown);
//             }
//         });
//     });
// });






// calendar -->



