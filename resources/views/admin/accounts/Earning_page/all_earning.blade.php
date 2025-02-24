@php
    $earningSource = App\Models\Earning::get()->unique('earn_source');
    $earning = App\Models\Earning::all();
    $total = $earning->sum('amount');
@endphp
@extends('admin.layout.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 ">

                @if (Request::isMethod('post'))
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="mb-3">
                            <h6 class="m-0 font-weight-bold text-primary">Search Earning Data</h6>
                        </div>
                        <div class="d-flex justify-content-evenly align-items-center mb-3">
                            <h6 class=" font-weight-bold text-primary">
                                <a href="{{ route('all.earning') }}">
                                    <button class="btn btn-info">View All Earning Data</button>
                                </a>
                            </h6>
                            <h6 class="font-weight-bold text-primary">
                                <a href="{{ route('add.earning') }}">
                                    <button class="btn btn-info">Add Earning</button>
                                </a>
                            </h6>
                            <h6 class="font-weight-bold text-primary">
                                <a onclick="printDiv('printContent')" class="btn btn-success waves-effect waves-light">
                                    <i class="fa fa-print"></i> Print Expense
                                </a>
                            </h6>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Earning</h6>
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('add.earning') }}">
                                <button class="btn btn-info">Add Earning</button>
                            </a>
                        </h6>
                    </div>
                @endif


                <div class="row">
                    <form method="POST" action="{{ route('get.earning') }}" id="searchEarning">
                        @csrf
                        <div class="errorMsgContainer"></div>
                        @if (Request::isMethod('post'))
                            <div class="input-group mb-3">
                                <input type="text" class="form-control ml-2 date_picker" name="start_date" id="start_date"
                                    value="{{ Request::post('start_date') }}">
                                <input type="text" class="form-control ml-2 date_picker" name="end_date" id="end_date"
                                    value="{{ Request::post('end_date') }}">
                                <select name="earning_source" id="earning_source" class="form-control" required
                                    data-parsley-required-message="Earing Source is required.">
                                    <option value="" selected disabled>Select Earning Source</option>
                                    @foreach ($earningSource as $item)
                                        <option value="{{ $item->earn_source }}"
                                            {{ $item->earn_source == $earning_source ? 'selected' : '' }}>
                                            {{ $item->earn_source }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                            </div>
                        @else
                            <div class="input-group mb-3">
                                <input type="text" placeholder="Enter Date" class="form-control ml-2 date_picker" name="start_date" id="start_date">
                                <input type="text" placeholder="Enter Date" class="form-control ml-2 date_picker" name="end_date" id="end_date">
                                <select name="earning_source" id="earning_source" class="form-control" required>
                                    <option value="" selected disabled>Select Earning Source</option>
                                    @foreach ($earningSource as $item)
                                        <option value="{{ $item->earn_source }}">{{ $item->earn_source }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="printContent">
                    @if (Request::isMethod('post'))
                        <h4 class="text-muted text-center">{{ $earning_source }} Earning
                            @if (Request::post('start_date') == null && Request::post('end_date') == null)
                                Result
                            @else
                                from {{ date('d-m-Y', strtotime(Request::post('start_date'))) }} to
                                {{ date('d-m-Y', strtotime(Request::post('end_date'))) }}
                            @endif
                        </h4>
                        <h3 class="text-muted text-center">Total Earning: BDT {{ $allEarning->sum('amount') }}/=</h3>
                    @else
                        <h3 class="text-muted text-center">Total Earning: BDT {{ $total + 312500 }} </h3> //567300
                    @endif
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Earining Source</th>
                                <th>Earining Head</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Earining Source</th>
                                <th>Earining Head</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (Request::isMethod('post'))
                                <tr></tr>
                            @else
                                <tr>
                                    <td>1</td>
                                    <td>Training</td>
                                    <td>Admission</td>
                                    <td>{{ $previousEarning }}</td>
                                    <td>Before 03-03-2023</td>
                                </tr>
                            @endif
                            @foreach ($allEarning as $key => $item)
                                <tr>

                                    @if (Request::isMethod('post'))
                                        <td>{{ $key + 1 }}</td>
                                    @else
                                        <td>{{ $key + 2 }}</td>
                                    @endif
                                    <td class="text-capitalize">
                                        {{ $item->earn_source }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->earn_head }}
                                    </td>
                                    <td>
                                        {{ $item->amount }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($item->date)) }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!--end row-->
    </div>

    <!-- End Page Content -->

    <

    <script>
        function printDiv(printContent) {
            let printContents = document.getElementById(printContent).innerHTML;
            let originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
