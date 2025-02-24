@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="company-details mt-5">
                                    <h5><strong>Customer Name : {{ $companyInfo->name }}</strong></h5>
                                    <p class="mb-0">Address : {{ $companyInfo->address }}</p>
                                    <p class="mb-0">Phone : {{ $companyInfo->phone }}</p>
                                    <p class="mb-0">E-mail : {{ $companyInfo->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-12 py-4">
                                <div class="row">
                                    <form method="POST" action="{{ route('get.account.detail') }}" id="searchEarning"
                                        autocomplete="off">
                                        @csrf
                                        <input type="hidden" name="company_id" id="company_id"
                                            value="{{ $companyInfo->id }}">
                                        <div class="errorMsgContainer"></div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control ml-2 date_picker" name="start_date"
                                                id="start_date" placeholder="Enter Start Date">
                                            <input type="text" class="form-control ml-2 date_picker" name="end_date"
                                                id="end_date" placeholder="Enter End Date">
                                            <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4 class="text-center">Account Details</h4>
                                <div class="payment-details">
                                     <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <h6 class="fw-bold">
                                                        Sl. No
                                                    </h6>
                                                </th>
                                                <th>
                                                    <h6 class="fw-bold">Date</h6>
                                                </th>
                                                <th>
                                                    <h6 class="fw-bold">Invoice</h6>
                                                </th>
                                                <th>
                                                    <h6 class="fw-bold">Voucher</h6>
                                                </th>
                                                <th>
                                                    <h6 class="fw-bold">Total Amount</h6>
                                                </th>
                                                <th>
                                                    <h6 class="fw-bold">Due Amount</h6>
                                                </th>
                                                <th>
                                                    <h6 class="fw-bold">Payment Amount</h6>
                                                </th>

                                                <th>
                                                    <h6 class="fw-bold">Balance</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_sum = '0';
                                            @endphp
                                            @foreach ($billDetails as $key => $details)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($details->date)) }}</td>
                                                    <td>
                                                        @if ($details->invoice_id != null  && $details->status == '0')
                                                            <a
                                                                href="{{ route('invoice.print.local', $details->invoice_id) }}">
                                                                #{{ $details['account_details']['invoice_no_gen'] }}
                                                            </a>
                                                        @elseif ($details->invoice_id == null && $details->status == '1')
                                                            Opening Balance
                                                        @elseif ($details->invoice_id == null && $details->status == '0')
                                                            Cash Payment
                                                        @elseif ($details->invoice_id != null && $details->status == '1')
                                                            #{{$details->invoice_id}}
                                                        @endif
                                                    </td>
                                                    <td>{{ $details->voucher }}</td>
                                                    <td>{{ number_format($details->total_amount) }}/-</td>
                                                    <td>{{ number_format($details->due_amount) }}/-</td>
                                                    <td>{{ number_format($details->paid_amount) }}/-</td>
                                                    <td>{{ number_format($total_sum += $details->total_amount - $details->paid_amount) }}/-
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
            </div>
        </div>
    </div>
@endsection
