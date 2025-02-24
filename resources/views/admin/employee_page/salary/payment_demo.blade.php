@extends('admin.admin_master')
@section('admin')
    {{-- <style>
        table.custome-table th,
        td {
            border: 1px solid red;
        }
    </style> --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    @php
                        $date = Carbon\Carbon::now()->format('Y');
                    @endphp
                    <h4 class="text-center my-3">Rupa Printing Press Salary Sheet - {{ $date }} </h4>
                    <div class="card-body">
                        <div class="employee-info">
                            <h5 class="text-muted">Employee Name: {{$employee->name}}</h5>
                            <h6 class="text-muted">Designation: {{ $employee->designation }}</h6>
                            <p class="text-muted mb-0">Joining Date: {{ $employee->joining_date }}</p>
                            <p class="text-muted mb-0">Salary: {{ $employee->salary }}</p>
                            <p class="text-muted">Phone: {{ $employee->phone }}</p>
                        </div>

                        @foreach ($data as $item)
                            <table class="table table-bordered mt-5" border="">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="12">
                                            <h2>{{$item->month}}</h2>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Sl</th>
                                        <th rowspan="3">Month</th>
                                        <th>Year</th>
                                        <th>salary</th>
                                        <th>OT Hour</th>
                                        <th>OT Amount</th>
                                        <th>Bonus</th>
                                        <th>Total Amount</th>
                                        <th>Payment Date</th>
                                        <th>Voucher No</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>1</td>
                                        <td style="vertical-align: middle;" rowspan="{{ count($paymentDetails) + 1 }}">
                                            {{ $item->month }}</td>
                                        <td style="vertical-align: middle;" rowspan="{{ count($paymentDetails) + 1 }}">
                                            {{ $item->year }}</td>
                                        <td>{{ $item->basic_salary }}</td>
                                        <td>{{ $item->ot_hour }}</td>
                                        <td>{{ $item->ot_payment }}</td>
                                        <td>{{ $item->bonus }}</td>
                                        <td>{{ $item->total_amount }}</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{ $item->total_amount }}</td>
                                    </tr>
                                    @php
                                        $total_sum = '0';
                                    @endphp
                                    @foreach ($paymentDetails as $key => $payment)
                                        <tr class="text-center">
                                            <td>{{ $key + 2 }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $payment->date }}</td>
                                            <td>{{ $payment->voucher }}</td>
                                            <td>{{ $payment->paid_amount }}</td>
                                            <td>{{ $payment->due_amount }}</td>
                                        </tr>
                                        @php
                                            $total_sum += $payment->paid_amount;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th></th>
                                        <th colspan="2">January Total</th>
                                        <th>{{ $item->basic_salary }}</th>
                                        <th>-</th>
                                        <th>-</th>
                                        <th>-</th>
                                        <th>{{ $item->total_amount }}</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ $total_sum }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    @include('admin.employee_page.salary.over_time_js');
    {{-- {!! Toastr::message() !!} --}}
@endsection
