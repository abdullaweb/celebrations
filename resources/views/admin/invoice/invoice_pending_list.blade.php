@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Invoice All</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('invoice.add') }}">
                    <button class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"> Add Invoice </i></button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->

        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Customer Name</th>
                                                <th>Invoice No</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Customer Name</th>
                                                <th>Invoice No</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($allData as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        {{
                                                            $item['payment']['customer']['name']
                                                         }}
                                                    </td>
                                                    <td>
                                                        #{{ $item->invoice_no }}
                                                    </td>
                                                    <td>
                                                        {{ date('d-m-Y', strtotime($item->date)) }}
                                                    </td>
                                                    <td>
                                                        {{ $item->description }}
                                                    </td>
                                                    <td>
                                                        {{ $item['payment']['total_amount'] }}
                                                    </td>
                                                    <td>
                                                        @if ($item->status == '0')
                                                            <span class="btn btn-warning">Pending</span>
                                                        @elseif($item->stuatus == '1')
                                                        <span class="btn btn-warning">Approved</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status == '0')
                                                            <a style="margin-left: 2px;"
                                                                href="{{ route('invoice.approve', $item->id) }}"
                                                                class="btn btn-dark" title="Approved Data">
                                                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                            </a>
                                                            <a id="delete" style="margin-left: 5px;"
                                                                href="{{ route('invoice.delete', $item->id) }}"
                                                                class="btn btn-danger" title="Delete Data">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
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

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
@endsection
