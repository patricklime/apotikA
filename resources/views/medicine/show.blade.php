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
          <a data-target="#detail_{{$data->id}}" data-toggle="modal">
            <img src="{{asset('assets/images/'.$data->image) }}"/>
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

@endsection
  