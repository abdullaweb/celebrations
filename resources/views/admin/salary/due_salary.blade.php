@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Begin Page Content -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Due Overtime</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.salary') }}">
                    <button class="btn btn-info">Add Sakary</button>
                </a>
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
                                <th>Employee Name</th>
                                <th>Due Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Employee Name</th>
                                <th>Due Salary</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($employees as $key => $employee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-capitalize">
                                        {{ $employee->name }}
                                    </td>
                                    @php

                                    $overtimeAmount = App\Models\Overtime::where('employee_id', $employee->id)
                                    ->where('year', date('Y'))
                                    ->sum('ot_amount');
                                    $bonusAmount = App\Models\Bonus::where('employee_id', $employee->id)
                                    ->where('year', date('Y'))
                                    ->sum('bonus_amount');
                                    $advanceAmount = App\Models\Advanced::where('employee_id', $employee->id)
                                    ->where('year', date('Y'))
                                    ->sum('advance_amount');
                                    $paySalary = App\Models\PaySalaryDetail::where('employee_id', $employee->id)
                                    ->where('paid_year', date('Y'))
                                    ->sum('paid_amount');
                                    $total_due = $employee->salary + $overtimeAmount + $bonusAmount - $advanceAmount
                                    -$paySalary;
                                    @endphp
                                    <td>
                                        {{ $total_due }}
                                    </td>
                                    <td>
                                        {{-- <a title="Update Salary" href="{{ route('edit.overtime', $employee->id) }}"
                                            class="btn btn-dark text-light">
                                            <i class="fas fa-edit    "></i>
                                        </a>
                                        <a id="delete" href="{{ route('delete.overtime', $employee->id) }}"
                                            class="ml-2 btn btn-danger" id="delete" title="Salary Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a> --}}
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
