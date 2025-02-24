@extends('admin.admin_master')
@section('admin')
    <!-- Begin Page Content -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="m-0 font-weight-bold text-primary">
                <h5 class="m-0 font-weight-bold text-primary">
                    Salary Overview
                </h5>
            </div>
            <div class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.overtime') }}">
                    <button class="btn btn-dark"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                </a>
            </div>
        </div>
        <!--end breadcrumb-->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <h5 class="m-3 font-weight-bold text-primary text-center">
                Salary of {{ $requestMonth }}
                <p class="m-0 font-weight-bold text-primary">Current Month : {{ date(' F, Y') }}</p>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="50%" class="fs-4">Head</th>
                                <th width="50%" class="fs-4">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th width="50%">Basic Salary</th>
                                <th width="50%">{{ number_format($basicSalary) }}</th>
                            </tr>
                            <tr>
                                <th width="50%">Overtime Salary</th>
                                <th width="50%">{{ number_format($overtimeAmount) }}</th>
                            </tr>
                            <tr>
                                <th width="50%">Bonus Salary</th>
                                <th width="50%">{{ number_format($bonusAmount) }}</th>
                            </tr>
                            <tr>
                                <th width="50%" class="fs-5">Gross Total</th>
                                <th width="50%">{{ number_format($grossTotal) }}</th>
                            </tr>
                            <tr>
                                <th width="50%">Advance Salary</th>
                                <th width="50%">({{ number_format($advanceAmount) }})</th>
                            </tr>
                            <tr>
                                <th width="50%">Paid Salary</th>
                                <th width="50%"> {{ number_format($paySalary) }}</th>
                            </tr>
                            <tr>
                                <th width="50%">Due Salary</th>
                                <th width="50%"> {{ number_format($dueAmount) }} </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- End Page Content -->
@endsection
