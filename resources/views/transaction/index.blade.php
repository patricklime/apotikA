@extends('layout.conquer')

@section('javascript')
<script>
  function getdetaildata(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("transaction.showAjax")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id
      },
      success: function(data){
        $('#msg').html(data.msg)
      }
    });
  }
</script>
@endsection

@section('content')
  <div class="container">
  <h2>Daftar Transaksi</h2>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Pembeli</th>
     
        <th>Tanggal Transaksi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
      <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->buyer->name}}</td>
      
        <td>{{$d->transaction_date}}</td>
        <td>
            <a class='btn btn-default' data-toggle='modal' data-target='#basic'
                onclick="getdetaildata({{$d->id}})">Lihat Detail Rincian</a>
        </td>
      </tr>
        @endforeach
    </tbody>
  </table>
</div>


<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-wide">
    <div class="modal-content" id="msg">
      

    </div>
  </div>
</div>

@endsection
  