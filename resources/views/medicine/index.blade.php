@extends('layout.conquer')

@section('content')
<div class="container">
  <h2>Daftar Obat</h2>
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
