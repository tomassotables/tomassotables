jQuery(document).ready(function($){



$("body").on("click","#btnSubmit",function(event){
  event.preventDefault();
    $.ajax({
      url: vince_manager.ajax_url,
      type: 'POST',
      dataType: "json",
      data:{
         'action' : 'import_data_status'
      },
      success: function(resp){  
        $("#resp").show().css("color", "green").html(resp.message);
      }

   });
   
});





});