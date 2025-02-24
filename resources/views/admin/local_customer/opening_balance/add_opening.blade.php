@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-muted">Add Opening Balance</h2>
                        <form class="custom-validation" action="{{ route('store.opening.balance') }}" method="POST"
                            novalidate="">
                            @csrf
                            <div class="row">
                                <div class="col-12 mt-3 mb-2">
                                    <div class="d-flex">
                                        <h5 class="text-muted">Choose your opening balance type</h5>
                                        <div style="margin-left: 50px;">
                                            <input type="radio" id="opening_balance" name="opening_type"
                                                value="opening_balance" required
                                                data-parsley-required-message="Balance type is required" />
                                            <label for="yes">Opening Balance</label>
                                            <input type="radio" id="billwise_balance" name="opening_type"
                                                value="billwise_balance">
                                            <label for="no">Bill Wise Balance</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" id="bill_no_field" style="display: none;">
                                    <div class="mb-2">
                                        <input type="text" name="bill_no" id="bill_no" placeholder="Enter Your Bill No"
                                            class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="mb-2">
                                        <select name="company_id" id="company_id" class="form-control select2" required
                                            data-parsley-required-message="Company Id is required" autocomplete="off">
                                            <option disabled selected>Select Company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }} -
                                                    {{ $company->phone }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="mb-2">
                                        <input type="digit" id="total_amount" name="total_amount" class="form-control"
                                            required="" data-parsley-trigger="keyup"
                                            data-parsley-validation-threshold="0" placeholder="Total Amount"
                                            data-parsley-type="number"
                                            data-parsley-type-message="Input must be positive number"
                                            data-parsley-required-message="Total Amount is required" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="mb-2">
                                        <input type="digit" id="paid_amount" name="paid_amount" class="form-control"
                                            required="" data-parsley-trigger="keyup"
                                            data-parsley-validation-threshold="0" placeholder="Paid Amount"
                                            data-parsley-type="number"
                                            data-parsley-type-message="Input must be positive number"
                                            data-parsley-required-message="Paid Amount is required" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="mb-3">
                                        <input type="text" autocomplete="off" id="date" name="date"
                                            class="form-control date_picker" required
                                            data-parsley-required-message="Date is required" placeholder="Enter Your Date">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-info waves-effect waves-light me-1">
                                    Add Balance
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[type=radio][name="opening_type"]').change(function() {
                let status = $(this).val();
                if (status == 'billwise_balance') {
                    $('#bill_no_field').show();
                } else {
                    $('#bill_no_field').hide();
                }
            });
        });
    </script>
@endsection
