    $("send").submit(function(){
      var text = $("text").val();
      var id_otkogo = $("id_otkogo").val();
      var id_komu = $("id_komu").val();
      var otkogo_name = $("otkogo_name").val();
       
       
      $.ajax({
          type: "POST",
          url: "add_mail.php",
          data: {"text": text,"id_otkogo": id_otkogo,"id_komu": id_komu,"otkogo_name": otkogo_name, },
          cache: false,
         success: function(response){
              var messageResp = new Array('Ваше сообщение отправлено','Сообщение не отправлено Ошибка базы данных','Нельзя отправлять пустые сообщения');
              var resultStat = messageResp[Number(response)];
              if(response == 0){
                 $("text").val("");
                 $("id_otkogo").val("");
                  $("id_komu").val("");
                 $("otkogo_name").val("");
                  
                
              }
              
                                                                
                                                }
           };