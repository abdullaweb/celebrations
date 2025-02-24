@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-muted">Add Advanced Salary</h2>
                        <form class="custom-validation" action="{{ route('store.advanced.salary') }}" method="POST"
                            novalidate="">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <div class="mb-2">
                                        <input type="digit" id="advanced_amount" name="advanced_amount"
                                            class="form-control" required="" data-parsley-trigger="keyup"
                                            data-parsley-validation-threshold="0" placeholder="Advanced Salary"
                                            data-parsley-type="number"
                                            data-parsley-type-message="Input must be positive number"
                                            data-parsley-required-message="Advanced Amount is required" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="mb-2">
                                        <select name="emp_id" id="emp_id" class="form-control" required
                                            data-parsley-required-message="Employee Id is required" autocomplete="off">
                                            <option disabled selected>Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }} -
                                                    {{ $employee->phone }} </option>
                                            @endforeach
                                        </select>
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
                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                    Add Advanced Salary
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
@endsection
