@extends('admin.layout.app')
@include('admin.alert')
@section('contents')
    <form action="{{ route('createProduct') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h2 class="mt-3">POS System</h2> --}}
        {{-- <div class="border border-dark border-opacity-25 position-absolute top-50 start-50 translate-middle "
            style="width: 50%; height: 80%; margin-top: 5%; margin-start: 3%;"> --}}
        <div class="card mt-4 " style="width: 70%; height: 80%; margin-left:15%">

            <div class="container p-3" style="margin-top: 10px;">
                <h4 class="mb-4 text-center">Create Product</h4>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="d-block barCodeDiv">
                            <label class="mb-1">Barcode <span class="text-danger">*</span>
                            </label><br>
                            <input
                                class="mb-4 mt-1  shadow-sm col-7 border border-dark border-opacity-25 @error('barcode') is-invalid
                            @enderror"
                                id="barCode" style="width: 65%; border-radius:5px;" type="text" name="barcode"
                                value="{{ old('barcode') }}">
                            <button class="border border-white col-4 btnCode" type="button">Barcode</button>
                            @error('barcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-block">
                            <label class="mb-1">Product Name <span class="text-danger">*</span>
                            </label>
                            <input
                                class="mb-4 form-control @error('product_name') is-invalid
                            @enderror"
                                type="text" name="product_name" value="{{ old('product_name') }}">
                            @error('product_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-block">
                            <label class="mb-1">Category <span class="text-danger">*</span>
                            </label>
                            <select name="category"
                                class="mb-4 form-control @error('category') is-invalid
                            @enderror"
                                aria-label="Default select example">
                                <option value="0" selected>Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="d-block">
                            <label class="mb-1 mt-1">Quantity</label>
                            <input
                                class="mb-4 form-control @error('quantity') is-invalid
                            @enderror"
                                type="text" name="quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="d-block">
                            <label class="mb-1 mt-1">Image <span class="text-danger">*</span>
                            </label>
                            <input
                                class="mb-4 form-control @error('image') is-invalid
                            @enderror"
                                type="file" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="d-block">
                            <label class="mb-1">Buy Price</label>
                            <input
                                class="mb-4 form-control @error('buy_price') is-invalid
                            @enderror"
                                type="text" name="buy_price" value="{{ old('buy_price') }}">
                            @error('buy_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="col-md-5">

                        <div class="d-block">
                            <label class="mb-1">Sell Price <span class="text-danger">*</span>
                            </label>
                            <input
                                class="mb-3 form-control @error('sell_price') is-invalid
                            @enderror"
                                type="text" name="sell_price" value="{{ old('sell_price') }}">
                            @error('sell_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <label class="mb-1 mt-1">MFD <span class="text-danger">*</span>
                            </label>
                            <input class="mb-4 form-control @error('mfd') is-invalid
                            @enderror"
                                type="date" name="mfd" value="{{ old('mfd') }}">
                            @error('mfd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <label class="mb-1">EXP <span class="text-danger">*</span>
                            </label>
                            <input class="mb-4 form-control @error('exp') is-invalid
                            @enderror"
                                type="date" name="exp" value="{{ old('exp') }}">
                            @error('exp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <label class="mb-1 mt-1">Description <span class="text-danger">*</span>
                            </label>
                            <textarea class="mb-4 form-control @error('description') is-invalid
                            @enderror"
                                type="text" name="description" value="{{ old('description') }}"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-11">
                    <button type="submit" class="btn btn-primary float-end ">Save</button>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </form>
@endsection
@section('scriptText')
    <script>
        $(document).ready(function() {
            $('.btnCode').click(function() {
                $code1 = Math.floor(100000 + Math.random() * 999999);
                $code2 = Math.floor(10000 + Math.random() * 99999);
                $finalCode = $code1 + '' + $code2;
                $parentNode = $(this).parents('.barCodeDiv');
                $barcode = $parentNode.find('#barCode');
                $barcode.val($finalCode);
                console.log(typeof($finalCode));
            })
        })
    </script>
@endsection
