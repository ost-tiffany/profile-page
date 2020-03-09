
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

function search() {
  $("#searchone").submit(function(event) {
    var carii = $("#carii").val();
    if(carii == "") {
      document.getElementById("errormessagesearch").innerHTML = "Please write at least 1 character";
      event.preventDefault();
      return false;
    }
  });
}

document.getElementById('delete').addEventListener('click',function(event) {confirmerase(e);},false);
    function confirmerase(){
    var conf = confirm("Are you sure you want to delete this photo?");
        if(!conf){
    event.preventDefault();
    }
}

document.getElementById('cancel').addEventListener('click',function(event) {confirmcancel(e);},false);
function confirmcancel(){
  var conf = confirm("Are you sure you want to cancel order?");
    if(!conf){
  event.preventDefault();
  }
}

$(document).ready(function() {
  $('.js-example-basic-single').select2( {
    ajax: (
      
    )
  });
});

// function cekkata() {
//     //ajax search js
//     var carii = document.getElementById('carii');
//     var containerdata = document.getElementById('containerdata');
//     // saat ketik search js
//     carii.addEventListener('keyup', function() {

//         if(carii.length >4) {
//             console.log("test");
//             var xhr = new XMLHttpRequest();
    
//             // cek kesiapan ajax (sumber ajaxnya respon)
//             //readystate itu kesiapan sebuah sumber, dari 0-4, 4 udah siap
//             //status, 200 artinya sumber oke, (kek 404 ga bisa kan?) bisa dicek di network
//             xhr.onreadystatechange = function() {
//                 if(xhr.readyState == 4 && xhr.status == 200) {
//                     containerdata.innerHTML = xhr.responseText;   
//                 }
//             }
    
//             //eksekusi ajax, method, sumber data ajax, asinkronus true, 
//             xhr.open('GET','gallerydata.php?carii=' + carii.value,false);
//             xhr.send();
//         }
//         // object ajaxnya 
//     });
// }
