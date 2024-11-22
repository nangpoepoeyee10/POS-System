@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
<div class="container">
    <form action="#" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <a href="{{ route('productlistPage') }}" class="text-black text-uppercase" style="font-weight: bold;"><i
                class="fa-solid fa-arrow-left mt-2 me-1"></i>Back</a> --}}
        <h4 class="mt-3 mb-1 ms-5" style="color: white;">Product Detail</h4>
        <div class="card mt-4 ms-5" style="width: 80%; height: 100%;">
            <div class="row" >
                <div class="col-5 ms-5">
                    @foreach ($product as $product)
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="d-block">
                            {{-- <label class="mb-3 mt-2">Image</label> --}}
                            <br>
                            <div style="width: 800px;">
                                @if ($product->image == null)
                                    <img src="{{ asset('images/adminProfile.png') }}" class=" w-25 h-25">
                                @else
                                    <img src="{{ asset('storage/' . $product->image) }}" class=" w-25 h-25">
                                @endif
                            </div>
                        </div>
                        <div class="d-block">
                            <label class="mb-2 mt-3">Barcode</label>
                            <input class="mb-4 form-control" type="text" name="barcode" value="{{ $product->barcode }}"
                                disabled>
                        </div>
                        <div class="d-block">
                            <label class="mb-2">Product Name</label>
                            <input class="mb-3 form-control" type="text" name="product_name"
                                value="{{ $product->product_name }}" disabled>
                        </div>

                    @endforeach
                    {{-- <div class="d-block">
                        <label class="mb-2">Buy Price</label>
                        <input class="mb-4 form-control" type="text" name="buy_price" value="{{ $product->buy_price }}"
                            disabled>
                    </div> --}}
                </div>
                <div class="col-5 ms-5 mt-3">
                    <div class="d-block">
                        <label class="mb-2">Category</label>
                        <select class="mb-1 form-select" aria-label="Default select example" name="categoryId"
                            value="{{ $product->category_name }}" disabled>
                            <option selected>Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->name == $product->category_name) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-block">
                        <label class="mb-2">Sell Price</label>
                        <input class="mb-3 form-control" type="text" name="sell_price"
                            value="{{ $product->sell_price }}" disabled>
                    </div>
                    <div class="d-block">
                        <label class="mb-2">MFD</label>
                        <input class="mb-4 form-control" type="date" name="mfd" value="{{ $product->mfd }}"
                            disabled>
                    </div>
                    <div class="d-block">
                        <label class="mb-2">EXP</label>
                        <input class="mb-3 form-control" type="date" name="exp" value="{{ $product->exp }}"
                            disabled>
                    </div>

                    <div class="d-block">
                        <label class="mb-2">Description</label>
                        <textarea  class="mb-4 form-control" type="text" name="description" disabled>{{ $product->description }}</textarea>
                    </div>

                </div>

            </div>
        </div>

    </form>
</div>

@endsection
