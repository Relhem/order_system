
<script>

function downloadImage(id){
    window.location = "http://localhost:8000/downloadImage?path="+id;
}

</script>

<div style="margin-top: 20px;">



    
    @if ($order -> status == 0)
    <div class="card w-100 alert-warning">
    @else
    @if ($order -> status == 1)
    <div class="card w-100 alert-success">
    @else
    <div class="card w-100 alert-secondary">
    @endif
    @endif


            <div class="card-body">   
                    <span style="font-size: 20px; margin-bottom: -10px;"> <b> {{$order -> order_key}} </b></span><br>

                    @switch($order->status)
                    @case(1)
                        Состояние заказа: <b>готово</b>.
                        @break
                
                    @case(2)
                        Состояние заказа: получен.
                        @break
                
                    @default
                        Состояние заказа: в работе.
                @endswitch

                    
                    <br>Дата создания:  {{$order -> created_at}}
                    <p class="card-text"> 
                        @if($order -> payed == 0)
                        Оплачен: <span style=" color: red;"><b>нет</b></span>.
                        @else 
                        Оплачен: <span style="color: green;"><b>да.</b></span>
                    @endif
                    <br>
                    Комментарий: 
                        <div id="{{$order -> id}}_descr">{!! nl2br(e($order -> description))!!}</div>       
                <br>    


                    </p>                   
            </div>
    </div>
    
    @if($order -> payed == 1)
    <br>
    <div style="text-align: center">
        <b>ИЗОБРАЖЕНИЯ</b>   <br><br>
   </div>
    @endif


    <div class="container" style="margin-top: 15px;">
    
        <div class="row row-cols-1 row-cols-md-3">
        @if($order -> payed == 1)

      


        @forelse ($images as $key => $image) 
        <div class="col mb-4">
            <div class="card h-100">
                <div style="padding: 10px;">
                Изображение #{{$key++}}
                </div>
               
              <img src="{{asset($image)}}" class="card-img-top" alt="...">
              <div class="card-body">
              
              </div>
              
              <div class="card-footer">
                <button type="submit" onclick="downloadImage('{{$image}}')" class="btn btn-success">Скачать</button>    
            </div>
    
            </div>
    
    
          </div>
         
        @empty
        @endforelse

        @endif

        </div>
    
    @if(empty($images))
    <div class="alert alert-info" role="alert">
        Нет ни одного прикреплённого изображения.
      </div>
    
    @else
    @if($order->payed == 0)
    <div class="alert alert-info" role="alert">
        Ваш заказ не оплачен. Изображения будут доступны после оплаты.
      </div>
    @endif
    @endif
    <br><br><br>
    </div>



</div>