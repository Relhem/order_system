@extends('main')

@section('title')
    {{ config('app.name') }} - Загрузка
@endsection

@section('content')

<script>


function printImages(){
        $.ajax({
        url: '/getImages/'+{{$order -> id}},
        data: {
                "_token": "{{ csrf_token() }}"},
        type: 'GET',
        success: function(result) {  
                $("#images").html(result);
        }
        }); 
    }

    printImages();

function HandleFileButtonClick()
    {
      event.preventDefault();
      $( "#photo" ).click();
       // document.frmUpload.myFile.click();
       // document.frmUpload.txtFakeText.value = document.frmUpload.myFile.value;
    }


function upload(){
      
    $("#progr").css("display","block");
    //  var id = $('input[name="id"]').val();
          var photo = $("#photo")[0].files[0];

 
          var formData = new FormData();

          formData.append('photo', photo);

      var fd = new FormData();
			var ins = document.getElementById('photo').files.length;
      fd.set('len', ins);
			for (var x = 0; x < ins; x++) {
				fd.append("photo-"+x, document.getElementById('photo').files[x]);
			}

            $.ajaxSetup({
          headers: {'X-CSRF-Token': '{{csrf_token()}}'}
      });
           
          $.ajax({
              xhr: function () {
               
                  var xhr = new window.XMLHttpRequest();
                  xhr.upload.addEventListener("progress", function (evt) {
                      if (evt.lengthComputable) {
                          var percentComplete = evt.loaded / evt.total;
                          percentComplete = parseInt(percentComplete * 100);
                          console.log(percentComplete);
                          $('.progress-bar').css('width', percentComplete + '%');
                          if (percentComplete === 100) {
                             

                              var imageUrl = window.URL.createObjectURL(photo)
                              $('.imgPreview').attr('src', imageUrl);
                              $('#d_status').html("Файлы были успешно загружены.<br><br>");
                              printImages();
                              setTimeout(function () {
                                  $('.progress-bar').css('width', '0%');
                                  $('#d_status').html("");
                                  $("#progr").css("display","none");
                               
                              }, 2000)
                          }
                      }
                  }, false);
                  return xhr;
              },
              url: '/upload/'+{{$order -> id}},
              type: 'POST',
              data: fd,
              processData: false,
              contentType: false,
              success: function (res) {   
                  if(!res.success){alert(res.error)}
              }
          })
     

}


function back() {
  window.history.back();
}


</script>


    <div class="container">

        <button onclick="back()" class="btn btn-primary">Назад</button>

            <div style="text-align: center; font-size: 15px; font-weight: 700;"> ИНФОРМАЦИЯ О ЗАКАЗЕ </div>
            <br>

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
                <span style="font-size: 15px; ">Создано: <b>{{$order -> creator}}</b></span>
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
    </div>


    <div class="container">

        <div class="row">
            <div class="col-md-12">          
            <br>
                <div>   
                    <div style="margin-left: 15px; flex-grow: 1">
                    
                        <input style="display: none" onchange="upload()" name="photos[]" id="photo" type="file" multiple>
                        <button type="button" class="btn btn-success" onclick="HandleFileButtonClick()">Выбрать файлы</button>
                        <br>
                        <br>

                        <div id="progr" style="display: none;">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">         
                            </div>                                          
                        </div>
                     </div>
                       
                        <div id="d_status"></div>
                    </div>
                </div>


            </div>
        </div>

    </div>


    <div id="images">

    </div>


@endsection