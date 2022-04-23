<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Tampilan Transaksi dari {{$cat->id}} - {{$cat->transaction_date}}</h4>
    </div>
    <div class="modal-body">
        <div class='row'>
            <table class="table">
                <thead>
                <tr>
                    <th>Gambar Produk</th>
                    <th>Data Produk</th>
                    <th>Detail Transaksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($dataObat as $d)
                        <tr>
                            <td>
                                <div class='col-md-4' style='width:100%;border:1px solid #eee;text-align:center'>
                                    <img src="{{asset('assets/images/'.$d->image)}}" height='200px' /></a><br>
                                    <p>{{$d->name}}</p>   
                                </div>
                                
                            </td>
                            <td>                                  
                                <p>Kategori : {{$d->category->category_name}}</p>
                                <p>Rp. {{$d->price}}</p>
                            </td>
                            <td>
                                <span>Jumlah pembelian : {{$d->pivot->quantity}} pcs</span><br>
                                <span>Total Harga : Rp {{$d->pivot->quantity * $d->pivot->price}}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>