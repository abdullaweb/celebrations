@extends('admin.admin_master')
@section('admin')
    <!-- Begin Page Content -->
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body py-5">
                        <form action="{{ route('update.overtime') }}" method="POST" class="custom-validation" novalidate=""
                            autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{ $overtimeInfo->id }}">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Employee Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control" name="employee_id" id="employee_id">
                                        <option selected disabled>Select Employee Name</option>
                                        @foreach ($employees as $employee)
                                            <option class="text-capitalize" value="{{ $employee->id }}"
                                                {{ $employee->id == $overtimeInfo->employee_id ? 'selected' : '' }}>
                                                {{ $employee->name }} - {{ $employee->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Overtime Hour</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="ot_hour" class="form-control" id="ot_hour"
                                        placeholder="Overtime hour" value="{{ $overtimeInfo->ot_hour }}" required=""
                                        data-parsley-trigger="keyup" data-parsley-validation-threshold="0"
                                        data-parsley-type="number" data-parsley-type-message="Input must be positive number"
                                        data-parsley-required-message="Ot Hour is required" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Select Month</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select name="month" id="month" class="form-control select2" required
                                            data-parsley-required-message="Month is required">
                                            <option disabled selected>Select Month</option>
                                            <option value="January" {{$overtimeInfo->month == 'January' ? 'selected' : ''}}>January</option>
                                            <option value="February" {{$overtimeInfo->month == 'February' ? 'selected' : ''}}>February</option>
                                            <option value="March" {{$overtimeInfo->month == 'March' ? 'selected' : ''}}>March</option>
                                            <option value="April" {{$overtimeInfo->month == 'April' ? 'selected' : ''}}>April</option>
                                            <option value="May" {{$overtimeInfo->month == 'May' ? 'selected' : ''}}>May</option>
                                            <option value="June" {{$overtimeInfo->month == 'June' ? 'selected' : ''}}>June</option>
                                            <option value="July" {{$overtimeInfo->month == 'July' ? 'selected' : ''}}>July</option>
                                            <option value="August" {{$overtimeInfo->month == 'August' ? 'selected' : ''}}>August</option>
                                            <option value="September" {{$overtimeInfo->month == 'September' ? 'selected' : ''}}>September</option>
                                            <option value="October" {{$overtimeInfo->month == 'Octobor' ? 'selected' : ''}}>October</option>
                                            <option value="November" {{$overtimeInfo->month == 'November' ? 'selected' : ''}}>November</option>
                                            <option value="December" {{$overtimeInfo->month == 'December' ? 'selected' : ''}}>December</option>
                                        </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Select Year</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select name="year" class="form-control" required
                                    data-parsley-required-message="Year is required">
                                    <option value="">Select Year</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}" {{ $overtimeInfo->year == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" autocomplete="off"
                                        value="{{ date('Y-m-d', strtotime($overtimeInfo->date)) }}" id="date"
                                        name="date" class="form-control date_picker" required
                                        data-parsley-required-message="Date is required" placeholder="Enter Your Date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 col-lg-9 text-secondary">
                                    <input type="submit" class="btn btn-info px-4" value="Update Overtime" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
