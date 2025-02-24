@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" class="custom-validation" action="{{ route('store.purchase') }}" novalidate=""
                            autocomplete="off">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Purchase Product</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="product_name" id="product_name" class="form-control"
                                        placeholder="Purchase Product" required
                                        data-parsley-required-message="Purchase Product is required">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Purchase Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="date" name="date" id="date" class="form-control date_picker"
                                        placeholder="Purchase Date" required
                                        data-parsley-required-message="Purchase date is required">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Purchase Quantity</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="product_qty" class="form-control product_qty"
                                        id="product_qty" placeholder="Purchase Quantity" required=""
                                        data-parsley-trigger="keyup" data-parsley-validation-threshold="0"
                                        data-parsley-type="number" data-parsley-type-message="Input must be positive number"
                                        data-parsley-required-message="Purchase Quantity is required" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Product Price</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="product_price" class="form-control product_price"
                                        id="product_price" placeholder="Product Price" required=""
                                        data-parsley-trigger="keyup" data-parsley-validation-threshold="0"
                                        data-parsley-type="number" data-parsley-type-message="Input must be positive number"
                                        data-parsley-required-message="Product Price is required" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Purchase Amount</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="total_amount" class="form-control total_amount"
                                        id="total_amount" placeholder="Purchase Amount" required=""
                                        data-parsley-trigger="keyup" data-parsley-validation-threshold="0"
                                        data-parsley-type="number" data-parsley-type-message="Input must be positive number"
                                        data-parsley-required-message="Purchase Amount is required" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 col-lg-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Add Purchase" />
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
