@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Begin Page Content -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="m-0 font-weight-bold text-primary">
                <h5 class="m-0 font-weight-bold text-primary">
                    Salary of {{ $requestMonth }}

                </h5>
            </div>
            <h6 class="m-0 font-weight-bold text-primary">
                <p class="m-0 font-weight-bold text-primary">Current Month : {{ date(' F, Y') }}</p>
            </h6>
        </div>
        <!--end breadcrumb-->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Month</th>
                                <th>Salary</th>
                                <th>Bonus</th>
                                <th>OT Amount</th>
                                <th>Total Salary</th>
                                <th>Advance</th>
                                <th>Paid Salary</th>
                                <th>Due Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Month</th>
                                <th>Salary</th>
                                <th>Bonus</th>
                                <th>OT Amount</th>
                                <th>Total Salary</th>
                                <th>Advance</th>
                                <th>Paid Salary</th>
                                <th>Due Salary</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($employees as $key => $employee)
                                @php
                                    $total_sum = '0';
                                    $advanced_amount = '0';
                                    $bonus_amount = '0';
                                    $overtime_amount = '0';
                                    $dueSalary = 0;

                                    $allBonus = App\Models\Bonus::where('employee_id', $employee->id)
                                        ->where('month', $requestMonth)
                                        ->where('year', $year)
                                        ->first();
                                    $allBonus === null
                                        ? ($bonus_amount = 0)
                                        : ($bonus_amount = $allBonus->bonus_amount);

                                    $advanced = App\Models\Advanced::where('employee_id', $employee->id)
                                        ->where('month', $requestMonth)
                                        ->where('year', $year)
                                        ->get();
                                    $advanced
                                        ? ($advanced_amount = $advanced->sum('advance_amount'))
                                        : ($advanced_amount = 0);

                                    $overtimes = App\Models\Overtime::where('employee_id', $employee->id)
                                        ->where('month', $requestMonth)
                                        ->where('year', $year)
                                        ->get();

                                    $pay_salary = App\Models\PaySalaryDetail::where('employee_id', $employee->id)
                                        ->where('paid_month', $requestMonth)
                                        ->where('paid_year', $year)
                                        ->get();
                                    $totalSalary = $employee->salary + $overtimes->sum('ot_amount') + $bonus_amount;
                                    $dueSalary = $totalSalary - $pay_salary->sum('paid_amount') - $advanced_amount;
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ !empty($employee->image) ? url($employee->image) : url('upload/no-image.jpg') }}"
                                            class="rounded-circle" width="46" height="40" alt="" />
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $employee->name }}
                                    </td>
                                    <td class="text-capitalize">
                                        <span class="badge bg-info">
                                            {{ $requestMonth }}
                                        </span>
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $employee->salary }}
                                    </td>


                                    <!--- bonus  -->
                                    <td class="text-capitalize">
                                        {{ $bonus_amount == 0 ? 'No Bonus' : number_format($bonus_amount) }}
                                    </td>

                                    <!--- overtime  -->
                                    <td>
                                        {{ $overtimes->isEmpty() ? 'No Ovetime' : number_format($overtimes->sum('ot_amount')) }}
                                    </td>

                                    <td> {{ number_format($totalSalary) }}</td>
                                    <td> {{ $advanced_amount == 0 ? 'No Advance' : number_format($advanced_amount) }}</td>
                                    <td>{{ $pay_salary->sum('paid_amount') }}</td>
                                    <td>{{ $dueSalary }}</td>

                                    <td>
                                        @if ($dueSalary != 0)
                                            <a title="Pay Salary" href="{{ route('pay.salary.now', $employee->id) }}"
                                                class="btn btn-info text-light">
                                                Pay Now </a>
                                        @endif
                                        <a title="Payment Details" style="margin-left: 5px;"
                                            href="{{ route('employee.payment.details', $employee->id) }}"
                                            class="btn btn-dark">
                                            Payment Details
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

    <!-- End Page Content -->
@endsection
