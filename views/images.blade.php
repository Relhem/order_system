<script>

function deleteImage(id){
$.ajax({
        url: '/deleteImage',
        data: {
                "_token": "{{ csrf_token() }}", "path":id},
        type: 'POST',
        success: function(result) {  
                printImages();
                notify('Изображение удалено.');
        }
        }); 
}

function downloadImage(id){
    window.location = "http://localhost:8000/downloadImage?path="+id;
}

</script>



<div class="container">
    
    <div class="row row-cols-1 row-cols-md-3">
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
            <button type="submit" onclick="deleteImage('{{$image}}')" class="btn btn-danger">Удалить</button>  
            <button type="submit" onclick="downloadImage('{{$image}}')" class="btn btn-success">Скачать</button>    
        </div>

        </div>


      </div>
        <!--<div style="width: 300px; height: 300px;">
                
                <img style="height: 50px;" src="{{asset($image)}}"/>
                <br><br>
       
                <br><br>

        </div>-->
    @empty
    @endforelse
    </div>

@if(empty($images))
<div class="alert alert-info" role="alert">
    Нет ни одного прикреплённого изображения.
  </div>
@endif

<br><br><br>
</div>