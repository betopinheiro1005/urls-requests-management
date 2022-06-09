$(function() {

    $('.bt_update_all_requests').click(function() {
        $.ajax({
          beforeSend:function(){
            $('.msg_user').html('Aguarde...');
          },
          type:"POST",
          data: "Operação realizada com sucesso!",
          url:"http://app-apisrequests.herokuapp.com/",
          success: function(data) {
            $('.msg_user').html(data);
          }
         
        });
        
      });

});


// $(function() {

// $('.bt_update_all_requests').click(function() {
//     $.ajax({
//       beforeSend:function(){
//         $('.msg_user').html('Aguarde...');
//       },
//       type:"POST",
//       data: "Operação realizada com sucesso!",
//       url:"https://orion3.com.br/urls_management/public/",
//       success: function(data) {
//         $('.msg_user').html(data);
//       }
     
//     });
    
//   });

// });


// });
