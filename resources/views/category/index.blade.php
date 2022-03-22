@extends('layout.conquer')

  <!-- <style type='text/css'>
        .container{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 3rem;
            margin-top: 30px;
        }
        .card{
            background: #ccc;
            min-height: 270px;
            padding: 1rem;
            border-radius: 20px;
            text-decoration: none;
            margin-bottom: 20px;
        }
        .card h4{
            margin-top: 8px;
            margin-bottom: 0;
            letter-spacing: 1.5px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 18px;
        }
        h4, h6{
            font-family: inherit;
            color: #0c0c0c;
            font-weight: 500;
        }
        .card h6{
            font-size: 14px;
            margin-top: 10px;
        }
       p{
           text-align: center;
       }
  </style> -->

@section('content')
<!-- <div class="container">
  @foreach($result as $d)
  <div class="card">
        <h4>{{$d->category_name}}</h4>
        <h6>{{$d->descriptions}}</h6>
        <p>Contoh Obat:</p>
        <div>
       
            @foreach($d->medicines as $m)
                {{$m->name}} 
                <ul>
                    <li>Form : {{$m->form}}</li>
                    <li>Price : {{$m->price}}</li>
                </ul>

            @endforeach
        
        </div>
    </div>
   @endforeach
</div> -->

<div class="container" style='width: 100%;'>
  <h2>Data Obat</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>Contoh</th>
        <th>formula</th>
        <th>harga</th>
      </tr>
    </thead>
    <tbody>
    @php($num =1)
    @foreach($result as $d)
      <tr>
        <td rowspan='{{count($d->medicines)}}'>{{$d->category_name}}</td>
        <td rowspan='{{count($d->medicines)}}'>{{$d->descriptions}}</td>

        @foreach($d->medicines as $m)

            @if($num > 1)
                <tr>
            @endif
           <td>{{$m->name}}</td>
           <td>{{$m->form}}</td>
           <td>{{$m->price}}</td>

           @if($num > 1)
                </tr>
            @endif

           @php($num++)
        @endforeach
        @php($num =1)
        </tr>
    @endforeach
    </tbody>
  </table>
@endsection
