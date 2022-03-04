<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar Kategori</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

  <style type='text/css'>
        .container{
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 3rem;
            margin-top: 30px;
        }
        .card{
            background: #ccc;
            height: 150px;
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
  </style>
</head>
<body>

<div class="container">
   
  @foreach($result as $d)
  <div class="card">
        <h4>{{$d->category_name}}</h4>
        <h6>{{$d->descriptions}}</h6>
    </div>
   @endforeach
</div>

</body>
</html>
