@extends('layout.conquer')
@section('content')

<div class="container">
  <h2>Data Obat Termahal</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Data</th>
        <th>Hasil</th>
      </tr>
    </thead>
    <tbody>
    @foreach($result as $d)
      <tr>
        <td>Medicine Name</td>
        <td>{{$d->name}}</td>
      </tr>
    <tr>
        <td>Category</td>
        <td>{{$d->category_name}}</td>
    </tr>
    <tr>
        <td>Harga</td>
        <td>{{$d->total}}</td>
    </tr>
    
    @endforeach
 
    </tbody>
  </table>
</div>
@endsection