@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold text-primary">Employee Over Time Details</h4>
                <h6 class="mt-2 text-muted">Employee Name: {{ $employee->name }}</h6>
                <h6 class="mt-2 text-muted">Employee Id: {{ $employee->employee_id }}</h6>
            </div>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('employee.salary.view') }}">
                    <button class="btn btn-info">Employee Salary List</button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>OT Hour</th>
                                    <th>OT Amount</th>
                                    <th>Effected Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>OT Hour</th>
                                    <th>OT Amount</th>
                                    <th>Effected Date</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->ot_hour }}
                                        </td>
                                        <td>
                                            {{ $item->ot_payment }}
                                        </td>
                                        <td>
                                             {{ $item->effected_date }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
