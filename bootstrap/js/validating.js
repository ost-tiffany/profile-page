
function validate() {
    $("#uploadform").submit(function(event) {

        var errormessage = [];
        var producttype = $("#product_type").val();
        var productname = $("#product_name").val();
        var uploadimage = $("#uploadimage").val();
        
          if(uploadimage == "") {
            errormessage.push("please upload an image");
        }
        
         if(productname == "") {
            errormessage.push("please input your product name");
          }
        
          if (producttype == 0) {
            errormessage.push("product type hasnt been chosen");
          }
        
          if (errormessage.length > 0 ) {
              event.preventDefault();
              temp = [];
              for (var i = 0; i < errormessage.length; i++) {
                  temp.push('<p>'+errormessage[i]+'</p><br>');		
              }
        
              $("#errormessage").html(temp);
            return false;
        }
        
        }
        
        );
        
}
