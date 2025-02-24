@extends('admin.admin_master')
@section('admin')
    <!-- Begin Page Content -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-muted">Pay Salary</h4>
                            <form class="custom-validation" action="{{ route('pay.salary.store') }}" method="POST"
                                novalidate="" id="form" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label for="" class="mb-2 mt-2"><b>Employee Name</b></label>
                                        <div class="mb-2">
                                            <input type="text" value="{{ $employee->name }}" class="form-control"
                                                readonly>

                                            <input type="hidden" name="employee_id" id="employee_id"
                                                value="{{ $employee->id }}" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="mb-2">
                                            <label for="" class="mb-2 mt-2"><b>Total Salary</b></label>
                                            <input type="text" name="total_salary" id="total_salary"
                                                value="{{ $total_salary }}" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="mb-2">
                                            <label for="" class="mb-2 mt-2"><b>Total Due</b></label>
                                            <input type="text" name="due_total" id="due_total"
                                                value="{{ $due_salary }}" class="form-control" readonly>
                                        </div>
                                    </div>



                                    <div class="col-md-6 mt-3">
                                        <div class="mb-2">
                                            <label for="" class="mb-2 mt-2"><b>Paid Amount</b></label>
                                            <input type="text" id="paid_amount" name="paid_amount" class="form-control"
                                                required="" data-parsley-trigger="keyup"
                                                data-parsley-validation-threshold="0" placeholder="Paid Amount"
                                                data-parsley-type="number"
                                                data-parsley-type-message="Input must be positive number"
                                                data-parsley-required-message="Paid Amount is required">
                                        </div>
                                    </div>


                                    <div class="col-md-6 mt-3">
                                        <div class="mb-3">
                                            <label for="" class="mb-2 mt-2"><b>Note</b></label>
                                            <input type="text" id="note" name="note" class="form-control"
                                                placeholder="Enter Note">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="mb-3">
                                            <label for="" class="mb-2 mt-2"><b>Paid Date</b></label>
                                            <input type="text" id="date" name="date"
                                                class="form-control date_picker" required
                                                data-parsley-required-message="Paid Date is required"
                                                placeholder="Paid Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-info waves-effect waves-light me-1">
                                        Pay Now
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#form').parsley();
    </script>
@endsection
