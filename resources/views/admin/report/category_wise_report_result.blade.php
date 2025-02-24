@extends('admin.admin_master')
@section('admin')
    <style>
        .table>:not(caption)>*>* {
            padding: 0 !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Begin Page Content -->
    <div class="page-content">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Category Report</h4>

                <div class="d-print-none">
                    <div class="float-end">
                        <a class="btn btn-info" href="{{ url()->previous() }}">Go Back</a>
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i
                                class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive py-3">
                    <div class="text-center">
                        <h4>
                            Sales from {{ date('d-m-Y', strtotime($start_date)) }} to
                            {{ date('d-m-Y', strtotime($end_date)) }}
                        </h4>
                        <h4>Total Sales: {{ $allSearchResult->sum('selling_price') }}</h4>
                    </div>
                    <table id="" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>Date</th>
                                <th>Bill No</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="text-center">
                                <th>Date</th>
                                <th>Bill No</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($allSearchResult as $key => $info)
                                <tr class="text-center">
                                    <td>{{ $info->date }}</td>
                                    <td>{{ $info->invoice_no_gen }}</td>
                                    <td> {{ $info['category']['name'] }} </td>
                                    <td> {{ number_format($info->selling_price) }}/- </td>
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
