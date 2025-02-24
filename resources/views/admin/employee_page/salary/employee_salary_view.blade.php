@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Employee Salary List</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.employee') }}">
                    <button class="btn btn-info">Add Employee</button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-10">
                <!-- Overtime Modal -->
                <div class="modal fade" id="AddHourModal" tabindex="-1" aria-labelledby="AddHourModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddHourModalLabel">Add Over Time Hour</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="custom-validation" action="" method="POST" novalidate=""
                                    id="AddHourForm">
                                    <div class="errorMsgContainer"></div>
                                    <input type="hidden" id="up_id" name="up_id">
                                    <div class="row">
                                        <div class="col-md mt-3">
                                            <div class="mb-3">
                                                <input type="digit" id="ot_hour" name="ot_hour" class="form-control"
                                                    required="" data-parsley-trigger="keyup"
                                                    data-parsley-validation-threshold="0" placeholder="Over Time Hour"
                                                    data-parsley-type="number"
                                                    data-parsley-type-message="Input must be positive number"
                                                    data-parsley-required-message="Over Time is required">
                                            </div>
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="mb-3">
                                                <input type="date" id="effected_date" name="effected_date"
                                                    class="form-control date_picker" required=""
                                                    data-parsley-required-message="Effected Date is required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light me-1 add-over-time">
                                                Add Hour
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
                
                
                <!-- Bonus Modal -->
                <div class="modal fade" id="AddBonusModal" tabindex="-1" aria-labelledby="AddBonusModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddHourModalLabel">Add Bonus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="custom-validation" action="" method="POST" novalidate=""
                                    id="AddBonusForm">
                                    <div class="errorMsgContainer"></div>
                                    <input type="hidden" id="up_id" name="up_id">
                                    <div class="row">
                                        <div class="col-md mt-3">
                                            <div class="mb-3">
                                                <input type="digit" id="bonus_amount" name="bonus_amount"
                                                    class="form-control" required="" data-parsley-trigger="keyup"
                                                    data-parsley-validation-threshold="0" placeholder="Bonus Amount"
                                                    data-parsley-type="number"
                                                    data-parsley-type-message="Input must be positive number"
                                                    data-parsley-required-message="Bonus is required">
                                            </div>
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="mb-3">
                                                <input type="date" id="date" name="date"
                                                    class="form-control date_picker" required=""
                                                    data-parsley-required-message="Effected Date is required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light me-1 add-bonus">
                                                Add Bonus
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
                                                <input type="digit" id="pay_amount" name="pay_amount"
                                                    class="form-control" required="" data-parsley-trigger="keyup"
                                                    data-parsley-validation-threshold="0" placeholder="Payment Amount"
                                                    data-parsley-type="number"
                                                    data-parsley-type-message="Input must be positive number"
                                                    data-parsley-required-message="Payment Amount required">
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
                                                <input type="date" id="payment_date" name="payment_date"
                                                    class="form-control" required=""
                                                    data-parsley-required-message="Date is required">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="payment_type">Payment Type</label>
                                                <br>
                                                <input type="radio" name="payment_type" value="salary" id="payment_type"> Salary
                                                <input type="radio" name="payment_type" value="advanced" style="margin-left: 20px;"> Advanced
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
                
                
                
                
                
                
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Phone</th>
                                    <th>Designation</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Phone</th>
                                    <th>Designation</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allData as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {{ $item->employee_id }}
                                        </td>
                                        <td>
                                            {{ $item->phone }}
                                        </td>
                                        <td>
                                            {{ $item->designation }}
                                        </td>
                                        <td>
                                            {{ $item->salary }}
                                        </td>

                                        <td style="display:flex">
                                            <a title="Salary Increment" style="margin-left: 5px;"
                                                href="{{ route('employee.salary.increment', $item->id) }}"
                                                class="btn btn-info">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </a>
                                            <a title="Employee Salary Details" style="margin-left: 5px;"
                                                href="{{ route('employee.salary.details', $item->id) }}"
                                                class="btn btn-dark">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#AddHourModal"
                                                title="Add Over Time Hour" style="margin-left: 5px;"
                                                class="btn btn-warning text-light fw-bolder editBtn"
                                                data-id="{{ $item->id }}">
                                                OT
                                            </a>
                                            <a type="button" href="{{ route('get.ot.details', $item->id) }}"
                                                title="Over Time Details" style="margin-left: 5px;"
                                                class="btn btn-dark text-light fw-bolder editBtn">
                                                OT Details
                                            </a>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#AddPaymentModal"
                                                title="Add Payment" style="margin-left: 5px;"
                                                class="btn btn-success text-light fw-bolder paymentBtn"
                                                data-id="{{ $item->id }}">
                                                Payment
                                            </a>
                                            <a target="_blank" type="button" title="Payment Deatils"
                                                style="margin-left: 5px;" class="btn btn-danger text-light fw-bolder"
                                                href="{{ route('payment.details', $item->id) }}">
                                                Payment Details
                                            </a>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#AddBonusModal"
                                                title="Add Bonus" style="margin-left: 5px;"
                                                class="btn btn-info text-light fw-bolder bonusBtn"
                                                data-id="{{ $item->id }}">
                                                Bonus
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
    @include('admin.employee_page.salary.over_time_js');
    @include('admin.employee_page.salary.add_payment_js');
    @include('admin.employee_page.salary.add_bonus_js');
    {!! Toastr::message() !!}
@endsection
