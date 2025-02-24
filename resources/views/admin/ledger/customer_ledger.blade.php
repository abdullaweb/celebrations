@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.company') }}">
                    <button class="btn btn-info">Add Customer</button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-12">

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
                                                <input type="digit" id="due_amount" name="due_amount" class="form-control"
                                                    readonly>
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
                                                <select id="bank_id" name="bank_id" class="form-control" required=""
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
                                                <input type="text" id="date" name="date" placeholder="Enter Date"
                                                    class="form-control date_picker" required=""
                                                    data-parsley-required-message="Date is required">
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


                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Total Order Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Total Due</th>
                                    <th>Total Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Total Order Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Total Due</th>
                                    <th>Total Order</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($customers as $key => $item)
                                    @php
                                        $paymentInfo = App\Models\Payment::where('company_id', $item->id)->get();
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        @php
                                            $total = $paymentInfo->sum('total_amount');
                                            $paid_amount = $paymentInfo->sum('paid_amount');
                                        @endphp
                                        <td>BDT {{ number_format($total) }}</td>
                                        <td>BDT {{ number_format($paymentInfo->sum('paid_amount')) }}</td>
                                        <td>BDT {{ number_format($item->total_due) }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $paymentInfo->count() }}</span>
                                        </td>
                                        <td>
                                            @if ($item->total_due != 0)
                                                <a title="Add Payment" style="margin-left: 5px;"
                                                    data-id="{{ $item->id }}" data-due="{{ $item->total_due }}"
                                                    class="btn btn-info paymentBtn" data-bs-toggle="modal"
                                                    data-bs-target="#paymentModal">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    Add Payment
                                                </a>
                                            @endif
                                            <a title="Payment History" style="margin-left: 5px;" class="btn btn-success"
                                                href="{{ route('customer.payment.history', $item->id) }}">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                Payment History
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


        @include('admin.ledger.customer_ledger_js')
    @endsection
