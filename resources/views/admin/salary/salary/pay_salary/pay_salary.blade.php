@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Begin Page Content -->
    <div class="app-main__inner">
        <!--breadcrumb-->
        <div class="card-header py-5 d-flex justify-content-between align-items-center">
            <div class="m-0 font-weight-bold text-primary">
                <h5 class="m-0 font-weight-bold text-primary">
                    Salary of {{ date('F', strtotime('-1 month')) }}

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
                                <th>Advance</th>
                                <th>Bonus</th>
                                <th>OT Amount</th>
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
                                <th>Advance</th>
                                <th>Bonus</th>
                                <th>OT Amount</th>
                                <th>Due Salary</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($employees as $key => $employee)
                                @php
                                    $total_sum = '0';
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($employee->image) }}" class="rounded-circle" width="46"
                                            height="40" alt="" />
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $employee->name }}
                                    </td>
                                    <td class="text-capitalize">
                                        <span class="badge badge-info">
                                            {{ date('F', strtotime('-1 month')) }}
                                        </span>
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $employee->salary }}
                                    </td>
                                    <td class="text-capitalize">
                                        @php
                                            $advanced = App\Models\Bonus::where('employee_id', $employee->id)->get();
                                        @endphp
                                        @if ($advanced->isEmpty())
                                            No Advanced
                                        @else
                                            @foreach ($advanced as $advance)
                                                {{ number_format($advance->advance_amount) }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-capitalize">
                                        @php
                                            $allBonus = App\Models\Bonus::where('employee_id', $employee->id)
                                                ->where('month', date('F', strtotime('-1 month')))
                                                ->where('year', date('Y'))
                                                ->get();
                                        @endphp
                                        @if ($allBonus->isEmpty())
                                            No Bonus
                                        @else
                                            @foreach ($allBonus as $bonus)
                                                {{ number_format($bonus->bonus_amount) }}
                                                @php
                                                    $total_sum += $bonus->bonus_amount;
                                                @endphp
                                            @endforeach
                                        @endif
                                    </td>
                                    @php
                                        $overtimes = App\Models\Overtime::where('employee_id', $employee->id)
                                            ->where('month', date('F', strtotime('-1 month')))
                                            ->where('year', date('Y'))
                                            ->get();
                                    @endphp
                                    <td>
                                        @if ($overtimes->isEmpty())
                                            No Overtime
                                        @else
                                            @foreach ($overtimes as $item)
                                                {{ number_format($item->ot_amount) }}
                                                @php
                                                    $total_sum += $item->ot_amount;
                                                @endphp
                                            @endforeach
                                        @endif
                                    </td>

                                    @php

                                        $pay_salary = App\Models\PaySalary::where('employee_id', $employee->id)
                                            ->where('paid_month', date('F', strtotime('-1 month')))
                                            ->where('paid_year', date('Y'))
                                            ->get();
                                    @endphp
                                    <td>
                                        @if ($pay_salary->isEmpty())
                                            {{ number_format($total_sum + $employee->salary) }}
                                        @else
                                            {{ number_format($total_sum + $employee->salary - $pay_salary->sum('paid_amount')) }}
                                        @endif
                                    </td>
                                    <td style="display:flex">
                                        <a title="Pay Salary" href="{{ route('pay.salary.now', $employee->id) }}"
                                            class="btn btn-info text-light">
                                            Pay Now </a>
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
