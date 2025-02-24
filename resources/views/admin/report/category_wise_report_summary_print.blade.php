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
        <!-- DataTales Example -->
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
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="text-center">
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </tfoot>
                        <tbody>

                             @foreach ($categories as $key => $category)
                                <tr class="text-center">
                                    <td> {{ $category->name }} </td>
                                    @php
                                        $sellingAmount = App\Models\InvoiceDetail::whereBetween('created_at', [$start_date, Carbon\Carbon::parse($end_date)->endOfDay()])->where('category_id', $category->id)->sum('selling_price');
                                    @endphp
                                    <td> {{ number_format($sellingAmount) }}/- </td>
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
