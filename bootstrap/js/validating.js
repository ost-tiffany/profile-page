
function validate() {
    $("#uploadform").submit(function(event) {

        var errormessage = [];
        var producttype = $("#product_type").val();
        var productname = $("#product_name").val();
        //var uploadimage_value = $("#uploadimage").val();

        //cara liat js files array 
        //[0] artinya filesnya 1 doang,liat dalemnya gitu
        //ternary operator
        var uploadimage = document.getElementById("uploadimage").files[0] ? document.getElementById("uploadimage").files[0] : '' ;

        if(uploadimage == '') {
            errormessage.push("please upload an image");
        }
        
         if(productname == "") {
            errormessage.push("please input your product name");
          }
        
          if (producttype == 0) {
            errormessage.push("product type hasnt been chosen");
          }
          
          //pake dan karena yang boleh kan cuma ini, kalo pake atau ntar ga jalan
          if(uploadimage!= '' && uploadimage.type != "image/jpeg" && uploadimage.type != "image/png") {
            errormessage.push("image ext only jpeg and png");
          }

          if(uploadimage.size > 6000000) {
            errormessage.push("image size is too big");
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

