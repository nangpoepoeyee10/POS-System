@extends('admin.layout.app')
@include('admin.alert')

@section('contents')

<div class="card">
    <div class="table-responsive">
        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <th>Barcode</th>
                <th>Product Name</th>
                <th>Sell Price</th>
                <th>Deleted At</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($product_deleted as $p)
                    <tr>
                        <td id="product_barcode" value="{{$p->barcode}}">{{$p->barcode}}</td>
                        <td>{{$p->product_name}}</td>
                        <td>{{$p->sell_price}}</td>
                        <td>{{$p->deleted_at}}</td>
                        <td><button id="btnRestore">Restore</button></td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection
@section('scriptText')
<script>
    $(document).ready(function(){
        $('#btnRestore').click(function(){

            var product_barcode = $('#product_barcode').html();
            $.ajax({
                method: 'get',
                url: '{{route('restoreProduct')}}',
                data: {
                    'product_barcode': product_barcode,
                },
                dataType: 'json',
                success: function(response){
                    if(response.message == 'success'){
                        window.location = '{{route('productlistPage')}}';
                    }
                }
            });
        })

    })
</script>

@endsection
