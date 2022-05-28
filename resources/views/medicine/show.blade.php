@extends('layout.conquer')

@section('javascript')
<script>
  function getEditForm(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("medicines.getEditForm")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id
      },
      success: function(data){
        $('#modalContent').html(data.msg)
      }
    });
  }

  function getEditForm2(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("medicines.getEditForm2")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id
      },
      success: function(data){
        $('#modalContent').html(data.msg)
      }
    });
  }

  function saveDataUpdateTD(id)
  {
   
   var faskes1 = ($("#eFaskes1").is(":checked")? 1:0);
   var faskes2 = ($("#eFaskes2").is(":checked")? 1:0);
   var faskes3 = ($("#eFaskes3").is(":checked")? 1:0);
    var name = $('#eName').val();
    var form = $('#eForm').val(); 
    var formula = $('#eFormula').val();
    var harga = $('#eHarga').val(); 
    var kategori = $('#eCategory').val();
    var deskripsi = $('#eDeskripsi').val();

    var foto = $('#eFoto').val();

    var sup = $('#eSupplier').val();

    var foto_data = foto.split(/(\\|\/)/g).pop();

    var flag = "http://127.0.0.1:8000/assets/images/";
    alert(foto_data);

    $.ajax({
      
      type:'POST',
      url:'{{route("medicines.saveData")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id,
        'myname':name,
        'myform':form,
        'myformula':formula,
        'myharga':harga,
        'mycategory':kategori,
        'myfoto':foto_data,
        'mydesk':deskripsi,
        'mysup':sup,
        'myfaskes1':faskes1,
        'myfaskes2':faskes2,
        'myfaskes3':faskes3,
      },
      success: function(data){
        if(data.status == 'oke'){
            alert(data.msg);
            $('#td_name').html(name);
            $('#td_form').html(form);
            $('#td_formula').html(formula);
            $('#td_harga').html(harga);
            $('#td_category').html(data.kat);         
            $('#td_foto').attr('src',  flag + data.img);
            
        }
       
      }
     
    });

  }

  function deleteDataRemoveTR(id)
  {
   
    $.ajax({
      type:'POST',
      url:'{{route("medicines.deleteData")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id
      },
      success: function(data){
        if(data.status == 'oke'){
            alert(data.msg);
            window.location.href='/medicines';
           
        }
        else{
          alert(data.msg);
        }
        
      }
    });
  }
</script>
@endsection

@section('content')

  <div class="container">
  <h2>Data Obat</h2>

  <div>
    @can('edit-permission-medicines',$data)
    <a href="{{url('medicines/'.$data->id.'/edit')}}" class="btn btn-xs btn-warning">Edit</a>

    <a href="#modalEdit" data-toggle='modal' class="btn btn-xs btn-info" onclick="getEditForm({{$data->id}})">+ Edit (A)</a>
          
    <a href="#modalEdit" data-toggle='modal' class="btn btn-xs btn-info" onclick="getEditForm2({{$data->id}})">+ Edit (B)</a><br><br>
    @endcan

    @can('delete-permission-medicines',$data)
    <form method="post" action="{{url('medicines/'.$data->id)}}">
      @csrf
      @method("DELETE")
      <input type="submit" value="delete" class="btn btn-xs btn-danger" onclick='if(!confirm("Are sure want to delete {{$data->name}}?")) return false;'>
    </form><br>

    <a class="btn btn-xs btn-danger" onclick='if(confirm("Are sure want to delete {{$data->name}}?")) deleteDataRemoveTR({{$data->id}})' >Delete 2</a>
    @endcan

  </div><br>

  <table class="table">
    <thead>
      <tr>
        <th>Data</th>
        <th>Hasil</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Generic Name </td>
        <td id='td_name'>{{$data->name}}</td>
      </tr>
      <tr>
        <td>Form</td>
        <td id='td_form'>{{$data->form}}</td>
      </tr>
      <tr>
        <td>Formula</td>
        <td id='td_formula'>{{$data->restriction_formula}}</td>
    </tr>
    <tr>
        <td>Category</td>
        <td id='td_category'>{{$data->category->category_name}}</td>
    </tr>
    <tr>
        <td>Harga</td>
        <td id='td_harga'>{{$data->price}}</td>
    </tr>
    <tr>
        <td>Foto</td>
        <td>
          <a id='td_a' data-target="#detail_{{$data->id}}" data-toggle="modal">
            <img id='td_foto' src="{{asset('assets/images/'.$data->image) }}"/>
          </a>
        </td>
      </tr>
  
    </tbody>
  </table>
</div>


  <div class="modal fade" id="detail_{{$data->id}}" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{$data->name}} {{$data->form}}</h4>
        </div>
        <div class="modal-body">
          <img src="{{asset('assets/images/'.$data->image) }}" height='400px' />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id='modalContent'>
        
      </div>
    </div>
  </div>

@endsection
  