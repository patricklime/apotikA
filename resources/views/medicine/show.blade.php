@extends('layout.conquer')
@section('content')
<div class="container">
  <h2>Data Obat</h2>
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
        <td>{{$data->name}}</td>
      </tr>
      <tr>
        <td>Form</td>
        <td>{{$data->form}}</td>
      </tr>
      <tr>
        <td>Formula</td>
        <td>{{$data->restriction_formula}}</td>
    </tr>
    <tr>
        <td>Category</td>
        <td>{{$data->category->category_name}}</td>
    </tr>
    <tr>
        <td>Harga</td>
        <td>{{$data->price}}</td>
    </tr>
    <tr>
        <td>Foto</td>
        <td>
          <img src="{{asset('assets/images/'.$data->image) }}"
            />
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection