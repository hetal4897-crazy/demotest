
          $(document).ready(function() {  
                $("#addEmail").on("click", function() { 
                    var id=Math.floor(100000 + Math.random() * 900000); 
                    $("#more-email").append("<div class='row' id="+id+"><div class='col-md-8'><label for='exampleInputEmail1'>Alternate email address</label><input type='email' class='form-control' required id='' placeholder='alt.mail@example.com'  name='email[]'/></div><div class='col-md-4 mdtop'><button id='removeContact' type='button' onclick='removerow("+id+")' class='btn btn-warning'><i class='fa fa-trash f-s-25' style='font-size: x-large;'></button></div></div>");  
                });  
                $("#removeEmail").on("click", function() {  
                    $("#more-email").children().last().remove();  
                });  
                $("#addContact").on("click", function() {  
                  var id=Math.floor(100000 + Math.random() * 900000);
                    $("#more-contact").append("<div class='row' id="+id+"><div class='col-md-8'><label for='exampleInputContact'>Alternate contact</label><input type='text' class='form-control' id='' required placeholder='+91-88888-88888'  name='phone[]'/></div><div class='col-md-4 mdtop'><button id='removeContact' type='button' class='btn btn-warning'  onclick='removerow("+id+")' ><i class='fa fa-trash f-s-25' style='font-size: x-large;'></i></button></div></div>");  
                });  
                $("#removeContact").on("click", function() {  
                    $("#more-contact").children().last().remove();  
                });  
            });
          $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span><input type='hidden' name='real_image[]'/>" +
            "</span>").insertBefore("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
    function delete_record(url) {
            if (confirm("Are u sure want to delete this post?")) {
                     window.location.href =url;
            } else {
                window.location.reload();
            }
    }
    function removeimg(id){

      $("#"+id).remove();
    }

    function  removerow(id){
      $("#"+id).remove();
    }

    $('#user_name').keypress(function( e ) {
    if(e.which === 32) 
        return false;
});