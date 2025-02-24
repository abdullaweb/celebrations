@extends('admin.admin_master')
@section('admin')
    <style>
        .select-year select {
            display: block;
            width: 100%;
            padding: .47rem .75rem;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.5;
            color: #505d69;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-muted">Add Advanced Salary</h4>
                            <form class="custom-validation" action="{{ route('store.advanced.salary') }}" method="POST"
                                novalidate="" id="form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <div class="mb-2">
                                            <select name="employee_id" id="employee_id" class="form-control select2" required
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
                                        <div class="mb-2">
                                            <select name="month" id="month" class="form-control select2" required
                                                data-parsley-required-message="Month is required">
                                                <option disabled selected>Select Month</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="mb-3">
                                            <select name="year" class="form-control select2" required
                                                data-parsley-required-message="Year is required">
                                                <option value="">Select Year</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="mb-2">
                                            <input type="digit" id="advanced_amount" name="advanced_amount"
                                                class="form-control" required="" data-parsley-trigger="keyup"
                                                data-parsley-validation-threshold="0" placeholder="Advanced Salary"
                                                data-parsley-type="number"
                                                data-parsley-type-message="Input must be positive number"
                                                data-parsley-required-message="Advanced Amount is required"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="mb-3">
                                            <input type="text" autocomplete="off" id="date" name="date"
                                                class="form-control date_picker" required
                                                data-parsley-required-message="Date is required"
                                                placeholder="Enter Your Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <button type="submit" class="btn btn-info waves-effect waves-light me-1">
                                        Add Advanced Salary
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
