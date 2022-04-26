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
      
      <a href="/medicines">Medicine</a>
        
    </li>
  </ul>

  <div class="page-toolbar">
        <!-- tempat action button -->        
        <a href="{{url('medicines/create')}}" class="btn btn-info" type="button">+ Medicines</a>
  </div>
</div>

<div class="container">
  <h2>Daftar Obat</h2>
 
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

   <div class="row">
      @foreach($result as $d)
      <div class="col-md-3" style='text-align: center; border: 1px solid #999; margin:5px;
              padding:5px; border-radius:10px; height: 270px;'>
          <img src="{{asset('assets/images/'.$d->image) }}"
           height="160px"><br>
           <a href="/medicines/{{$d->id}}">
              <b>{{$d->name}}</b> <br>
              <p>{{$d->form}}</p>
          </a>
      </div>
      @endforeach
    </div>
</div>
@endsection
