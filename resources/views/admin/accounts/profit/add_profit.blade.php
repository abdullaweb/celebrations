@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" class="custom-validation" action="{{ route('store.purchase') }}" novalidate="" autocomplete="off">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Purchase Amount</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="product_name" id="product_name" class="form-control"
                                        placeholder="Purchase Product" required data-parsley-required-message="Purchase Product is required">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Expense Amount</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="purchase_amount" class="form-control" id="purchase_amount"
                                        placeholder="Purchase Amount" required="" data-parsley-trigger="keyup"
                                        data-parsley-validation-threshold="0" data-parsley-type="number"
                                        data-parsley-type-message="Input must be positive number"
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
        </div> --}}
        <!-- start page title -->
        <div class="row mt-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Date Wise Profit Report</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Profit Report</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <form   method="POST" action="{{ route('get.profit') }}">
                @csrf
                <div class="errorMsgContainer"></div>
                <div class="input-group mb-3">
                    <input type="date" class="form-control ml-2 date_picker" required  name="start_date" id="start_date">
                    <input type="date" class="form-control ml-2 date_picker"  required name="end_date" id="end_date">
                    <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>


    {{-- js --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
@endsection
