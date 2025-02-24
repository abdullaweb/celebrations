@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Monthly Salary List</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('employee.salary.view') }}">
                    <button class="btn btn-info">Employee Salary List</button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- Payment Modal -->
                    <div class="modal fade" id="AddPaymentModal" tabindex="-1" aria-labelledby="AddPaymentModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AddPaymentModalLabel">Add Payment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="custom-validation" action="" method="POST" novalidate=""
                                        id="AddPaymentForm">
                                        <div class="errorMsgContainer"></div>
                                        <input type="hidden" id="up_id" name="up_id">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="">Payment Amount</label>
                                                    {{-- <select class="form-control" name="emp_paid_status" id="emp_paid_status">
                                                <option value="" disabled selected>Select Payment</option>
                                                <option value="full_paid">Full Paid</option>
                                                <option value="partial_paid">Partial Paid</option>
                                            </select> --}}
                                                    <input type="digit" id="pay_amount" name="pay_amount"
                                                        class="form-control" required="" data-parsley-trigger="keyup"
                                                        data-parsley-validation-threshold="0" placeholder="Payment Amount"
                                                        data-parsley-type="number"
                                                        data-parsley-type-message="Input must be positive number"
                                                        data-parsley-required-message="Payment Amount required">


                                                    {{-- <input style="display: none;" type="digit" id="amount" name="amount" class="form-control"
                                                required="" data-parsley-trigger="keyup"
                                                data-parsley-validation-threshold="0" placeholder="Payment Amount"
                                                data-parsley-type="number"
                                                data-parsley-type-message="Input must be positive number"
                                                data-parsley-required-message="Payment Amount required"> --}}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="">Payment Voucher</label>
                                                    <input type="text" id="voucher" name="voucher" class="form-control"
                                                        placeholder="Payment Voucher" required=""
                                                        data-parsley-required-message="Voucher is required">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="">Payment Date</label>
                                                    <input type="date" id="date" name="date"
                                                        class="form-control date_picker" required=""
                                                        data-parsley-required-message="Payment Date is required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-0">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light me-1 add-payment">
                                                    Add Payment
                                                </button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Basic Salary</th>
                                    <th>OT Hour</th>
                                    <th>OT Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due Salary</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Basic Salary</th>
                                    <th>OT Hour</th>
                                    <th>OT Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due Salary</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item['employee']['name'] }}
                                        </td>
                                        <td>
                                            {{ $item['employee']['employee_id'] }}
                                        </td>
                                        <td>
                                            {{ $item->basic_salary }}
                                        </td>
                                        <td>
                                            {{ $item->ot_hour }}
                                        </td>
                                        <td>
                                            {{ $item->ot_payment }}
                                        </td>
                                        <td>
                                            @if ($item->paid_amount == null)
                                                0
                                            @else
                                                {{ $item->paid_amount }}
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $due = $item->total_amount - $item->paid_amount;
                                            @endphp
                                            {{ $due }}
                                        </td>
                                        <td>
                                            @if ($due == 0)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-danger">Unpaid</span>
                                            @endif
                                        </td>
                                        <td style="display:flex">
                                            @if ($due != 0)
                                                <a id="#delete" type="button" data-bs-toggle="modal" data-bs-target="#AddPaymentModal"
                                                    title="Add Payment" style="margin-left: 5px;"
                                                    class="btn btn-success text-light fw-bolder paymentBtn"
                                                    data-id="{{ $item->emp_id }}">Paid
                                                </a>
                                            @endif
                                            <a style="margin-left: 5px" title="Pay Slip"
                                                href="{{ route('pay.slip', $item->emp_id) }}" class="btn btn-info">Pay Slip
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    @include('admin.employee_page.salary.add_payment_js');
    {{-- {!! Toastr::message() !!} --}}
@endsection
