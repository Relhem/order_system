
<script>

    function setStatus(id)
{
    var val = $("#select_"+id).val();
   
    var iVal = 0;
    if (val == "В работе")
        iVal = 0;
        if (val == "Готово")
        iVal = 1;   
        if (val == "Получен")
        iVal = 2;

                $.ajax({
        url: '/setStatus/' + id,
        data: {
                "_token": "{{ csrf_token() }}", "status": iVal},
        type: 'POST',
        success: function(result) {  
            printOrdersList();
            notify('Статус изменён.');
        }
        }); 
}

function deleteOrder(id) {
 $.ajax({
url: '/deleteOrder/' + id,
data: {
        "_token": "{{ csrf_token() }}"},
type: 'DELETE',
success: function(result) {  
    printOrdersList();
    notify('Заказ '+result['deleted_key']+' удалён.');
}
}); 
}

function changePayed(id) {
 $.ajax({
url: '/changePayed/' + id,
data: {
        "_token": "{{ csrf_token() }}"},
type: 'POST',
success: function(result) {  
    printOrdersList();
    notify('Заказ изменён.');
}
}); 
}


var wasEdited = new Set();
var isEditing = false;

function setEdit(id) {

if (!isEditing){

var descr = $('#'+id+'_descr').html();

if (!wasEdited.has(id)){
descr = descr.split("<br>").join("");
wasEdited.add(id);
} else
{
descr = descr.replace(/(<br>|<\/br>|<br \/>)/mgi, "\n");
}

    $('#'+id+'_descr').html('<textarea id="'+id+'_descr_text" rows="4" cols="50">'+descr+'</textarea>');
    $('#'+id+'_save').css('display','block');
    isEditing = true;
} else
{
   
}

}

function setBack(id, text) {
    text = text.replace(new RegExp('\r?\n','g'), '<br>');
    $('#'+id+'_descr').html(text);
    $('#'+id+'_save').css('display','none');
}

function save(id) {
var val = $.trim($('#'+id+'_descr_text').val());
    if (val != "") {
                $.ajax({
        url: '/editDescription/' + id,
        data: {
                "_token": "{{ csrf_token() }}",
                "description": val 
                },
        type: 'POST',
        success: function(result) {  
            setBack(id, val);
            notify("Сохранено.")
            isEditing = false;
        }
        }); 
    }
}

var target;
function setTarget(id) {
    target = id;
}

</script>

 
<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLongTitle">Удаление</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Действительно удалить заказ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
          <button type="button" data-dismiss="modal" onclick="deleteOrder(target)" class="btn btn-danger">Удалить</button>
        </div>
      </div>
    </div>
  </div>



<div>
{{ $orders->links('') }}
@forelse ($orders as $order)
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

    <div style="position: absolute; right: 10px;">

    <!-- <button type="submit" onclick="deleteOrder({{ $order-> id }})" class="btn btn-danger">Удалить</button>  -->

    <button type="button" onclick="setTarget({{$order->id}})" class="btn btn-danger" data-toggle="modal" data-target="#modalCenter">
        Удалить
      </button>

    <a href="/upload/{{$order -> id}}" class="btn btn-primary">Загрузить</a>
    </div>

    <span style="font-size: 20px; margin-bottom: -10px;"> <b> {{$order -> order_key}} </b></span><br>
    <span style="font-size: 15px; ">Создано: <b>{{$order -> creator}}</b></span>
    <br>Дата создания:  {{$order -> created_at}}
    <p class="card-text"> 
        @if($order -> payed == 0)
        Оплачен: <span style="cursor: pointer; color: red;" onclick="changePayed({{$order -> id}})"><b>нет</b></span>.
        @else 
        Оплачен: <span style="cursor: pointer; color: green;" onclick="changePayed({{$order -> id}})"><b>да.</b></span>
     @endif
     <br>
    <span style="cursor: pointer;" onclick="setEdit({{$order -> id}})"> Комментарий: 
        <div id="{{$order -> id}}_descr">{!! nl2br(e($order -> description))!!}</div> 
    </span>
   
<br>     <button type="submit" onclick = "save({{$order -> id}})"class="btn btn-success" id = "{{$order -> id}}_save" style="display: none;">Сохранить</button>  

    </p>        

  
    
        Статус заказа: 
      <select class="form-control" onchange="setStatus({{$order -> id}})" id="select_{{$order -> id}}" style="width: 180px; display: inline; padding: 0px; margin: 0px;">
        
        @if ($order -> status == 0)
            <option selected>В работе</option>
        @else 
            <option>В работе</option>
        @endif

        @if ($order -> status == 1)
        <option selected>Готово</option>
        @else 
        <option>Готово</option>
        @endif

        @if ($order -> status == 2)
        <option selected>Получен</option>
        @else 
        <option>Получен</option>
        @endif

      </select>
    
  
    

    

  </div>
</div>
<br>
@empty

<div class="alert alert-info" role="alert">
  Заказы не найдены.
</div>

@endforelse   
</div>