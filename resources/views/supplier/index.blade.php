@extends('layout.conquer')

@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="fa fa-home"></i>
      <a href="/">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      
      <a href="/supplier">Supplier</a>
        
    </li>
  </ul>

  <div class="page-toolbar">
        <!-- tempat action button -->        
        <a href="{{url('supplier/create')}}" class="btn btn-info" type="button">+ Supplier</a>
  </div>
</div>

<div class="container" style='width: 100%; cellspacing:0;'>
  <h2>Data Supplier</h2>
  
  @if(session('status'))
      <div class="alert alert-success">
          {{session('status')}}
      </div>
  @endif

  @if(session('error'))
      <div class="alert alert-danger">
          {{session('error')}}
      </div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Alamat</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
      <tr>
        <td>{{$d->name}}</td>
        <td>{{$d->address}}</td>
        <td><a href="{{url('supplier/'.$d->supplier_id.'/edit')}}" class="btn btn-xs btn-info">Edit</a></td>

        <td>
          <form method="post" action="{{url('supplier/'.$d->supplier_id)}}">
            @csrf
            @method("DELETE")
            <input type="submit" value="delete" class="btn btn-xs btn-danger" onclick='if(!confirm("Are sure want to delete it?")) return false;'>
          </form>
        </td>
      </tr>
    @endforeach

    </tbody>
  </table>
@endsection