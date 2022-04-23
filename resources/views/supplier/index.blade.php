@extends('layout.conquer')

@section('content')
<div class="container" style='width: 100%; cellspacing:0;'>
  <h2>Data Supplier</h2>
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
      </tr>
    @endforeach

    </tbody>
  </table>
@endsection
