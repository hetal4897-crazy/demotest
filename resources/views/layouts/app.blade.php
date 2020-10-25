<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
           <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
        <style type="text/css">
            .form-container { margin-top: 50px; min-height: 350px;}
.bs-callout { padding: 10px 20px; margin: 20px 0; border: 1px solid #c6eaf5; border-left-width: 5px; border-radius: 3px; background: #ddf6fd; color: #1b809e;}
.bs-callout-info { border-left-color: #1b809e;}
        </style>
        
          <style type="text/css">
              });
input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
          </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
    <script type="text/javascript">
          $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('postdatatable') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'user_name', name: 'user_name'},
                    {data: 'brithdate', name: 'brithdate'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
          });
          $(document).ready(function() {  
                $("#addEmail").on("click", function() {  
                    $("#more-email").append("<div class='row'><div class='col-md-8'> <div class='form-group'><label for='exampleInputEmail1'>Alternate email address</label><input type='email' class='form-control' id='' placeholder='alt.mail@example.com'  name='email[]'/></div></div></div>");  
                });  
                $("#removeEmail").on("click", function() {  
                    $("#more-email").children().last().remove();  
                });  
                $("#addContact").on("click", function() {  
                    $("#more-contact").append("<div class='row'><div class='col-md-8'<div class='form-group'><label for='exampleInputContact'>Alternate contact</label><input type='text' class='form-control' id='' placeholder='+91-88888-88888'  name='phone[]'/></div></div></div>");  
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
    </script>
</html>
