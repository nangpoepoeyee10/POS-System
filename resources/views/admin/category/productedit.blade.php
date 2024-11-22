@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
<div class="container">
    <form action="{{ route('updateProduct') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h4 class="mt-3 mb-1" style="color: white;">Edit Product</h4>

        <div class="card mt-4 col-12">

            <div class="row mt-3">
                <div class="col-5 ms-5">
                    @foreach ($product as $product)
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="d-block">
                        <label class="mb-2">Barcode</label>
                        <input class="mb-4 form-control" type="text" name="barcode" value="{{$product->barcode}}" disabled>
                    </div>
                    <div class="d-block">
                        <label class="mb-2">Name</label>
                        <input class="mb-4 form-control" type="text" name="product_name" value="{{$product->product_name}}">
                    </div>
                    <div class="d-block">
                        <label class="mb-2">Category</label>
                        <select class="form-select" aria-label="Default select example" name="categoryId" value="{{$product->category_name}}">
                            <option selected>Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->name == $product->category_name) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-block">
                        <label class="mb-2 mt-3">Image</label>
                        <input class="mb-2 form-control" type="file" name="image" value="{{$product->image}}">
                         @if ($product->image == null)
                        <img src="{{ asset('images/adminProfile.png') }}"
                            class=" w-25 h-25">
                    @else
                        <img src="{{ asset('storage/' . $product->image) }}"
                            style="width: 20%; height: 20%;">
                    @endif
                    </div>
                    @endforeach
                    {{-- <div class="d-block">
                        <label class="mb-2 mt-2">Buy Price</label>
                        <input class="mb-4 form-control" type="text" name="buy_price" value="{{$product->buy_price}}">
                    </div> --}}
                </div>

                <div class="col-5 ms-5">

                    <div class="d-block">
                        <label class="mb-2">Sell Price</label>
                        <input class="mb-4 form-control" type="text" name="sell_price" value="{{$product->sell_price}}">
                    </div>
                    <div class="d-block">
                        <label class="mb-2">MFD</label>
                        <input class="mb-4 form-control" type="date" name="mfd" value="{{$product->mfd}}">
                    </div>
                    <div class="d-block">
                        <label class="mb-2">EXP</label>
                        <input class="mb-3 form-control" type="date" name="exp" value="{{$product->exp}}">
                    </div>

                    <div class="d-block">
                        <label class="mb-2">Description</label>
                        <textarea class="mb-4 form-control" type="text" name="description">{{$product->description}}</textarea>
                    </div>
                    <div class="text-end col-12 mb-3">
                        <button type="submit" class="btn btn-primary"> Update</button>
                    </div>
                </div>

            </div>


        </div>
    </form>
</div>

@endsection
