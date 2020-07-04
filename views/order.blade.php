<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v3.8.6">



     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>    {{ config('app.name') }} - Информация о заказе</title>
    
    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Подключаем jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    
    <!-- Подключаем плагин Popper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
    <!-- Подключаем Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous" ></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <link href="{{asset('css/starter-template.css')}}" rel="stylesheet">
  </head>


  <script>

function getOrderInfo(){
    var id = $("#order_key").val();
    if (id == "") id = -1;
        $.ajax({
        url: '/order/'+id,
        data: {
                "_token": "{{ csrf_token() }}"},
        type: 'GET',
        success: function(result) {  
                $("#order_info").html(result);
        },
        error: function(jqxhr, status, errorMsg) {
				$('#order_info').html("<br><div class=\"alert alert-info\" role=\"alert\">Такого заказа не существует.</div>")
			}
        }); 
    }
   
   function notify(text)
      {
          $("#notification").html(text);
          $('#notification').css("display","block");
          $('#notification').css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
          setTimeout(function(){
            $('#notification').fadeTo(200, 0);
            $('#notification').css("display","none");
          }, 2000);     
      }
    
   </script>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">photoLab</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      </div>
   </nav>


  



  <main role="main">
     <div class="starter-template" >

      
        <div class="alert alert-info" role="alert" id="notification" style="visibility: hidden; position: fixed; z-index: 9999;">
          notification
        </div>


            <div class="container col-5 card" style="padding: 25px; margin-top: 10%;">
               <div style="text-align: center">
                    <b>СТАТУС ЗАКАЗА</b>   <br><br>
               </div>
            

               <div class="form-group">
                <label for="order_key">ID вашего заказа:</label>
                <input type="text" class="form-control" id="order_key" placeholder="ID заказа">
              </div>
                
              <div style="text-align: center">
                <button class="btn btn-success col-md-4" type="submit" onclick="getOrderInfo()">Проверить</button>
             </div>
            </div>

        
            <div class="container" id="order_info">
                
                


            </div>

      </div>
  </main> 

            
  </body>
</html>

