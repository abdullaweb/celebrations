@php
    $purchaseAmount = App\Models\Purchase::all();
    $total = $purchaseAmount->sum('total_amount');
@endphp
@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Begin Page Content -->
    <div class="page-content">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-12 py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">All Opening</h6>
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('add.opening.balance') }}">
                                <button class="btn btn-info">Add Balance</button>
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Bill No</th>
                                <th>Phone</th>
                                <th>Total Amount</th>
                                <th>Total Payment</th>
                                <th>Total Due</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Bill No</th>
                                <th>Phone</th>
                                <th>Total Amount</th>
                                <th>Total Payment</th>
                                <th>Total Due</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($allOpening as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-capitalize">
                                        {{ $item['company']['name'] }}
                                    </td>
                                    <td>
                                        @if ($item->invoice_id == null && $item->status == '1')
                                            Opening Balance
                                        @elseif ($item->invoice_id == null && $item->total_amount == null && $item->status == '1')
                                            Cash Payment
                                        @elseif ($item->invoice_id != null && $item->status == '1')
                                            #{{ $item->invoice_id }}
                                        @endif
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item['company']['phone'] }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->total_amount }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->paid_amount }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->due_amount }}
                                    </td>
                                    <td style="display:flex;">
                                        <a title="Edit Balance" href="{{ route('edit.opening.balance', $item->id) }}"
                                            class="btn btn-info text-light">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <a title="Delete Balance" style="margin-left: 5px;"
                                            href="{{ route('delete.opening.balance', $item->id) }}" class="btn btn-danger"
                                            id="delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
