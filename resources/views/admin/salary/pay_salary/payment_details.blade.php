@extends('admin.admin_master')
@section('admin')
    <!-- Begin Page Content -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Salary Sheet</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;" class="text-light"><i
                                    class="bx bx-home-alt text-light"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Salary Sheet</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr>



        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    @php
                        $date = Carbon\Carbon::now()->format('Y');
                    @endphp
                    <h4 class="text-center my-3">Salary Sheet </h4>
                    <div class="card-body">
                        <div class="employee-info mb-5">
                            <h5 class="text-muted">Employee Name: {{ $employee->name }}</h5>
                            <h6 class="text-muted">Designation: {{ $employee->designation }}</h6>
                            <p class="text-muted mb-0">Joining Date:
                                {{ date('d-M, Y', strtotime($employee->joining_date)) }}
                            </p>
                            <p class="text-muted mb-0"><strong>Salary: {{ $employee->salary }}</strong></p>
                            <p class="text-muted mb-0">Phone: {{ $employee->phone }}</p>
                            @php
                                $advanced_amount = App\Models\Advanced::where('employee_id', $employee->id)->first();
                            @endphp
                        </div>

                        @foreach ($payment_salary as $item)
                            <table id="datatable" class="table table-bordered dt-responsive nowrap mt-5"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <thead>
                                        <tr class="text-center">
                                            <th colspan="12">
                                                <h4>Month Of
                                                    <strong style="font-weight: 400;">{{ $item->paid_month }},
                                                        {{ $item->paid_year }}</strong>
                                                </h4>
                                            </th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>Sl</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Salary</th>
                                            <th>OT Hour</th>
                                            <th>OT Amount</th>
                                            <th>Bonus</th>
                                            <th>Advanced</th>
                                            <th>Payment Date</th>
                                            <th>Note</th>
                                            <th>Paid Amount</th>
                                            <th>Due Amount</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @php
                                        $paymentDetails = App\Models\PaySalaryDetail::where(
                                            'employee_id',
                                            $employee->id,
                                        )
                                            ->where('paid_month', $item->paid_month)
                                            ->where('paid_year', $year)
                                            ->get();
                                    @endphp
                                    <tr class="text-center">
                                        <td>1</td>
                                        <td style="vertical-align: middle;" rowspan="{{ count($paymentDetails) + 1 }}">
                                            {{ $item->paid_month }}</td>
                                        <td style="vertical-align: middle;" rowspan="{{ count($paymentDetails) + 1 }}">
                                            {{ $year }}</td>
                                        <td style="vertical-align: middle;" rowspan="{{ count($paymentDetails) + 1 }}">
                                            {{ $employee->salary }}</td>
                                        @php
                                            $advanced = App\Models\Advanced::where('employee_id', $employee->id)
                                                ->where('month', $item->paid_month)
                                                ->where('year', $year)
                                                ->first();
                                            $overtimes = App\Models\Overtime::where('employee_id', $employee->id)
                                                ->where('month', $item->paid_month)
                                                ->where('year', $year)
                                                ->get();
                                            $bonus = App\Models\Bonus::where('employee_id', $employee->id)
                                                ->where('month', $item->paid_month)
                                                ->where('year', $year)
                                                ->first();
                                            $total = '0';
                                            $paid_total = '0';
                                            $total += $employee->salary;
                                            $advanced_amount = 0;
                                            if ($advanced == null) {
                                                $advanced_amount += 0;
                                            } else {
                                                $advanced_amount += $advanced->advance_amount;
                                            }
                                        @endphp

                                        <!-- overtime -->

                                        @if ($overtimes)
                                            <td>{{ $overtimes->sum('ot_hour') }}</td>
                                            <td>{{ $overtimes->sum('ot_amount') }}</td>
                                            @php
                                                $total += $overtimes->sum('ot_amount');
                                            @endphp
                                        @else
                                            <td>0</td>
                                            <td>0</td>
                                            @php
                                                $total += 0;
                                            @endphp
                                        @endif

                                        <!-- bonus -->
                                        @if ($bonus == null)
                                            <td>0</td>
                                            @php
                                                $total += 0;
                                            @endphp
                                        @else
                                            <td>{{ $bonus->bonus_amount }}</td>
                                            @php
                                                $total += $bonus->bonus_amount;
                                            @endphp
                                        @endif

                                        <td>({{ $advanced_amount }})</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{ $total - $advanced_amount }}</td>
                                    </tr>

                                    @foreach ($paymentDetails as $key => $details)
                                        <tr class="text-center">
                                            <td>{{ $key + 2 }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{ $details->paid_date }}</td>
                                            <td>{{ $details->note }}</td>
                                            <td>{{ number_format($details->paid_amount) }}</td>

                                            <td>
                                                @if ($details->paid_type == 'Advanced')
                                                    {{ number_format($total - $paid_total - $advanced_amount) }}
                                                @else
                                                    @php
                                                        $paid_total += $details->paid_amount;
                                                    @endphp
                                                    {{ number_format($total - $paid_total - $advanced_amount) }}
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection
