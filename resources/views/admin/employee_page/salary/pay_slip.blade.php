    @extends('admin.admin_master')
    @section('admin')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <div class="page-content">
            <!--breadcrumb-->
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered " border="">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">
                                            <h4>Rupa Printing Press</h4>
                                            <h6>Pay Slip the date of {{$data->effected_date}}</h6>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Employee Name</th>
                                        <th scope="col">{{ $data['employee']['name'] }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Employee ID</th>
                                        <th scope="col">{{ $data['employee']['employee_id'] }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Designation</th>
                                        <th scope="col">{{ $data['employee']['designation'] }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Basic Salary</th>
                                        <th scope="col">{{ $data->basic_salary}}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Overtime Hour</th>
                                        <th scope="col">{{ $data->ot_hour}}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Overtime Payment</th>
                                        <th scope="col">{{ $data->ot_payment}}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">{{ $data->total_amount}}</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Payment</th>
                                        @if ($data->paid_amount == null)
                                        <th scope="col">0</th>
                                        @else
                                        <th scope="col">{{ $data->paid_amount }}</th>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th scope="col">Due Amount</th>
                                        <th scope="col">{{ $data->payable_amount }}</th>
                                    </tr>
                                </thead>
                                <tbody>
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
