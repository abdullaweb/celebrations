@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Credit Company</h6>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Compnay ID</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Due Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Compnay ID</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Due Amount</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allData as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item['company']['name'] }}
                                        </td>
                                        <td>
                                            {{ $item['company']['company_id'] }}
                                        </td>
                                        <td>
                                            #{{  $item['invoice']['invoice_no'] }}
                                        </td>
                                        <td>
                                            {{ date('Y-m-d', strtotime($item['invoice']['date'] )) }}
                                        </td>
                                        <td>
                                            {{ $item['due_amount']}}
                                        </td>

                                        <td style="display:flex">
                                            <a style="margin-left: 5px;" href="{{ route('edit.credit.customer', $item->invoice_id)}}"
                                                class="btn btn-info">
                                                <i class="fas fa-edit"></i> Due Payment
                                            </a>
                                            <a style="margin-left: 5px;"
                                                href="{{ route('customer.invoice.details', $item->invoice_id) }}" class="btn btn-secondary"
                                                title="Customer Invoice Details">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    @endsection
