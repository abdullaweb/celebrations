@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body py-5">
                        <form action="{{ route('update.advanced.salary') }}" method="POST" class="custom-validation"
                            novalidate="" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{ $advancedSalary->id }}">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Employee Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control select2" name="employee_id" id="employee_id">
                                        <option disabled>Select Employee Name</option>
                                        @foreach ($employees as $employee)
                                            <option class="text-capitalize" value="{{ $employee->id }}"
                                                {{ $employee->id == $advancedSalary->employee_id ? 'selected' : '' }}>
                                                {{ $employee->name }} - {{ $employee->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Advance Salary Month</h6>
                                </div>
                                <div class="col-sm-9">
                                    <div class="mb-2">
                                        <select name="month" id="month" class="form-control select2" required
                                            data-parsley-required-message="Month is required" autocomplete="off">
                                            <option disabled selected>Select Month</option>
                                            <option value="January"
                                                {{ $advancedSalary->month == 'January' ? 'selected' : '' }}>January</option>
                                            <option value="February"
                                                {{ $advancedSalary->month == 'February' ? 'selected' : '' }}>February
                                            </option>
                                            <option value="March"
                                                {{ $advancedSalary->month == 'March' ? 'selected' : '' }}>March</option>
                                            <option value="April"
                                                {{ $advancedSalary->month == 'April' ? 'selected' : '' }}>April</option>
                                            <option value="May" {{ $advancedSalary->month == 'May' ? 'selected' : '' }}>
                                                May</option>
                                            <option value="June"
                                                {{ $advancedSalary->month == 'June' ? 'selected' : '' }}>June</option>
                                            <option value="July"
                                                {{ $advancedSalary->month == 'July' ? 'selected' : '' }}>July</option>
                                            <option value="August"
                                                {{ $advancedSalary->month == 'August' ? 'selected' : '' }}>August</option>
                                            <option value="September"
                                                {{ $advancedSalary->month == 'September' ? 'selected' : '' }}>September
                                            </option>
                                            <option value="October"
                                                {{ $advancedSalary->month == 'October' ? 'selected' : '' }}>October
                                            </option>
                                            <option value="November"
                                                {{ $advancedSalary->month == 'November' ? 'selected' : '' }}>November
                                            </option>
                                            <option value="December"
                                                {{ $advancedSalary->month == 'December' ? 'selected' : '' }}>December
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Amount</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="advanced_amount" class="form-control" id="advanced_amount"
                                        placeholder="Advanced Amount" required="" data-parsley-trigger="keyup"
                                        data-parsley-validation-threshold="0" data-parsley-type="number"
                                        data-parsley-type-message="Input must be positive number"
                                        data-parsley-required-message="Amount is required"
                                        value="{{ $advancedSalary->advance_amount }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" autocomplete="off" id="date" name="date"
                                        class="form-control date_picker" required
                                        data-parsley-required-message="Updated Date is required"
                                        placeholder="Enter Your Date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 col-lg-9 text-secondary">
                                    <input type="submit" class="btn btn-info px-4" value="Update Advanced" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
