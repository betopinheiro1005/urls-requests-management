$(function() {

    /* HEROKU */

    $('.bt_update_all_requests').click(function() {
        $.ajax({
          beforeSend:function(){
            $('.msg_user').html("<img src='https://app-apisrequests.herokuapp.com/images/updating.gif' width='40px'><br />Aguarde!<br />Atualizando requisições...");
          },
          type:"POST",
          data: {
            "message": "Operação realizada com sucesso!",
            "status_code": "200"
          },
          url:"http://app-apisrequests.herokuapp.com/",
          success: function(data) {
            // $('.msg_user').html(data);
            $('.msg_user').text(JSON.stringify(data));
          }
         
        });
        
      });

      $('.bt_update_one_request').click(function() {
        $.ajax({
          beforeSend:function(){
            $('.msg_user').html("<img src='https://app-apisrequests.herokuapp.com/images/updating.gif' width='40px'><br />Aguarde!<br />Atualizando requisição...");
          },
          type:"POST",
          data: "Operação realizada com sucesso!",
          url:"http://app-apisrequests.herokuapp.com/",
          success: function(data) {
            $('.msg_user').html(data);
          }
         
        });
        
      });


      /* ORION 3 */

      // $('.bt_update_all_requests').click(function() {
      //   $.ajax({
      //     beforeSend:function(){
      //       $('.msg_user').html("<img src='https://orion3.com.br/urls_management/public/images/updating.gif' width='40px'><br />Aguarde!<br />Atualizando requisições...");
      //     },
      //     type:"POST",
      //     data: "Operação realizada com sucesso!",
      //     url:"https://orion3.com.br/urls_management/public/",
      //     success: function(data) {
      //       $('.msg_user').html(data);
      //     }
        
      //   });
        
      // });
  
      // $('.bt_update_one_request').click(function() {
      //   $.ajax({
      //     beforeSend:function(){
      //       $('.msg_user').html("<img src='https://orion3.com.br/urls_management/public/images/updating.gif' width='40px'><br />Aguarde!<br />Atualizando requisição...");
      //     },
      //     type:"POST",
      //     data: "Operação realizada com sucesso!",
      //     url:"https://orion3.com.br/urls_management/public/",
      //     success: function(data) {
      //       $('.msg_user').html(data);
      //     }
        
      //   });
        
      // });
  
});
  