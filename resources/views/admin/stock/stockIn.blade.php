@extends('admin.layout.app')
@include('admin.alert')

@section('contents')
    <form action="{{ route('createStock') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card mt-4" style="width: 80%; height: 80%; margin-left:10%; margin-right: 10%;">
            <div class="container p-3" style="margin-top: 10px;">
                <h4 class="mb-3 text-center">Add Stock</h4>
                <div class="row justify-content-center" style="">
                    <div class="col-10 " style="">
                        <div class="d-block">
                            <label class="mb-2">Product Name <span class="text-danger">*</span>
                            </label>
                            <select
                                class="form-control @error('product_id') is-invalid
                            @enderror"
                                aria-label="Default select example" name="product_id">
                                <option value="0" selected>Name</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="d-block">
                            <label class="mb-2">Quantity <span class="text-danger">*</span>
                            </label>
                            <input class="mb-4 form-control @error('qty') is-invalid
                        @enderror"
                                type="text" name="qty" value={{ old('qty') }}>
                            @error('qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <label class="mb-2">Purchase Price <span class="text-danger">*</span>
                            </label>
                            <input
                                class="mb-4 form-control @error('purchasePrice') is-invalid
                            @enderror"
                                type="text" name="purchasePrice" value={{ old('purchasePrice') }}>
                            @error('purchasePrice')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <label class="mb-2">Date <span class="text-danger">*</span>
                            </label>
                            <input class="mb-4 form-control @error('date') is-invalid
                            @enderror"
                                id="date" type="date" name="date" value={{ old('date') }}>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-block mt-3">
                            <button type="submit" style="float: right;" class="btn btn-primary float-center">Save
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
