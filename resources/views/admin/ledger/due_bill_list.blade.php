@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Due Bill Ledger</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('invoice.add') }}">
                    <button class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"> Add Bill </i></button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- Account Payment Modal -->
                    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="paymentModalLabel">Customer Due Payment</h5>
                                    <button type="button" class="btn-close closeBtn" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="custom-validation" novalidate="" id="paymentForm" autocomplete="off">
                                        <div class="errorMsgContainer"></div>
                                        <input type="hidden" id="customer_id" name="customer_id">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="due_amount">Due Amount</label>
                                                    <input type="digit" id="due_amount" name="due_amount"
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="digit" id="amount" name="amount" class="form-control"
                                                        required="" data-parsley-trigger="keyup"
                                                        data-parsley-validation-threshold="0" min="1"
                                                        placeholder="Enter Pay Amount" data-parsley-type="number"
                                                        data-parsley-type-message="Input must be positive number"
                                                        data-parsley-required-message="Due Payment Amount is required">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <select id="bank_id" name="bank_id" class="form-control"
                                                        required=""
                                                        data-parsley-required-message="Paid Source is required">
                                                        <option selected disabled>Select Paid Source</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="bank">Bank</option>
                                                        <option value="bkash">Bkash</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" id="payment_note" name="payment_note"
                                                        placeholder="Enter Payment Note" class="form-control" required=""
                                                        data-parsley-required-message="Payment Note is required">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" id="date" name="date"
                                                        placeholder="Enter Date" class="form-control date_picker"
                                                        required="" data-parsley-required-message="Date is required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-0">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-info waves-effect waves-light me-1 add-customer-payment">
                                                    Save Changes
                                                </button>
                                                <button type="button" class="btn btn-secondary closeBtn"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Bill No</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Due Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Bill No</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Due Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <a href="{{ route('invoice.print',$item->invoice_id)}}">
                                                    #{{ $item->invoice->po_number }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $item->company->name }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($item->invoice->date)) }}
                                            </td>
                                            <td>
                                                @php
                                                    $dueAmount =
                                                        $item->previous_due + $item->total_amount - $item->paid_amount;
                                                @endphp
                                                <span>&#2547; {{ number_format($dueAmount) }}
                                            </td>
                                            <td>
                                                <a title="Add Payment" style="margin-left: 5px;"
                                                    data-id="{{ $item->company_id }}" data-due="{{ $dueAmount }}"
                                                    class="btn btn-info paymentBtn" data-bs-toggle="modal"
                                                    data-bs-target="#paymentModal">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    Add Payment
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.ledger.customer_ledger_js')
@endsection
