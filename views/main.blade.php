<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v3.8.6">



     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     
     <!-- Scripts -->
     <!--<script src="{{ asset('js/app.js') }}" defer></script> -->
 

    <title>@yield('title')</title>

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

          
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Главная<span class="sr-only">(current)</span></a>
            </li>

            <!--

          <li class="nav-item">
            <a class="nav-link" href="#">Logout</a>
          </li>

          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>-->

          </ul> 
        <form class="form-inline my-2 my-lg-0">
       <!--   <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"> -->
          
        

    
        </form> 
        <span style="margin-right: 15px; color: white;">
          Пользователь: <b>{{  Auth::user()->name }}</b>
        </span>

        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Выйти</button>
        </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>


      </div>
   </nav>


  



  <main role="main">
     <div class="starter-template" >

      
        <div class="alert alert-info" role="alert" id="notification" style="visibility: hidden; position: fixed; z-index: 9999;">
          notification
        </div>
      

      
      @if (session('status'))
      <div class="container">
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
      </div>
     @endif
     
  

         @yield('content')


      </div>
  </main> 


  <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
            
  </body>
</html>

