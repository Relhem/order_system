@extends('main')

@section('title')
    {{ config('app.name') }} - Главная
@endsection

@section('content')


    
    <script>



function newOrder(){
            $.ajax({
        url: '/create',
        data: {
                "_token": "{{ csrf_token() }}"},
        type: 'POST',
        success: function(result) {  
               printOrdersList();
               notify("Новый заказ создан.");
        }
        }); 
    }

    function searchOrder(key){
            $.ajax({
        url: '/orders',
        data: {"order_key" : key,
                "_token": "{{ csrf_token() }}"
                },
        type: 'GET',
        success: function(result) {  
            $("#orders").html(result);
        }
        }); 
    }

function printOrdersList(){
        $.ajax({
        url: '/orders',
        data: {
                "_token": "{{ csrf_token() }}"},
        type: 'GET',
        success: function(result) {  
                $("#orders").html(result);
        }
        }); 
    }

    function refresh()
    {
        printOrdersList();
        notify('Список обновлён.');
    }

$( document ).ready(function() {

    $('#key_input').keydown(function(e) {
    if(e.keyCode === 13) {
        var key = $("#key_input").val();
        if (key == 0)
            printOrdersList() 
        else
            searchOrder(key);
        return false;
    }
  });


    function fetch_data(page)
    {
        $.ajax({
        url:"/orders?page="+page,
        type:'GET',
        success:function(data)
        {
            $('#orders').html(data);
        }
        });
    }
    
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    

    printOrdersList();

});

    </script>


    <div class="container">
       
        <button type="button" class="btn btn-success" onclick="newOrder()">Новый заказ</button>
        <button type="button" class="btn btn-primary" onclick="refresh()">Обновить</button>
        <br><br>
        <input class="form-control" id="key_input" placeholder="Код заказа..." >
        <br/><br/>

       <div id="orders"></div>

    </div>

@endsection