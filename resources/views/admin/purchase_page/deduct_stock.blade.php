@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('update.deduct.stock')}}" method="POST" class="custom-validation" novalidate=""
                            autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{ $purchaseInfo->id }}">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Purchase Product</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control" name="product_name" id="product_name">
                                        <option selected disabled>Select Product Name</option>
                                        @foreach ($purchases as $purchase)
                                            <option class="text-capitalize" value="{{ $purchase->product_name }}"
                                                {{ $purchase->id == $purchaseInfo->id ? 'selected' : '' }}>
                                                {{ $purchase->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Current Stock</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" readonly class="form-control" value="{{$purchaseInfo->product_qty}}" name="current_stock" id="current_stock">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Stock Deduct</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="duduct_qty" class="form-control"
                                        id="duduct_qty" placeholder="Deduct Quantity" required=""
                                        data-parsley-trigger="keyup" data-parsley-validation-threshold="0"
                                        data-parsley-type="number" data-parsley-type-message="Input must be positive number"
                                        data-parsley-required-message="Deduct Quantity is required" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 col-lg-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Deduct Stock" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- js --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    {{--  add more purchase   --}}
    <script>
        $(document).ready(function() {

            $(document).on("keyup", ".product_price,.product_qty", function() {
                let product_qty = $('input.product_qty').val();
                let product_price = $('input.product_price').val();
                let total = product_price * product_qty;
                $('input.total_amount').val(total);
            });
        });
    </script>
@endsection
