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
                        <h6 class="m-0 font-weight-bold text-primary">All Purchase</h6>
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('add.purchase') }}">
                                <button class="btn btn-info">Add Purchase</button>
                            </a>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <form method="POST" action="{{ route('get.purchase') }}">
                        @csrf
                        <div class="errorMsgContainer"></div>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control ml-2 date_picker" name="start_date" id="start_date">
                            <input type="date" class="form-control ml-2 date_picker" name="end_date" id="end_date">
                            <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="card-body">
                <h4 class="text-muted text-center">Total Purchase Amount {{ $total }}</h4>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allPurchase as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-capitalize">
                                        {{ $item->product_name }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->product_qty }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->product_price }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ date('Y-m-d', strtotime($item->date)) }}
                                    </td>
                                    <td>
                                        {{ $item->total_amount }}
                                    </td>
                                    <td style="display:flex">
                                        <a href="{{ route('edit.purchase', $item->id) }}" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('purchase.stock', $item->id) }}" class="btn btn-dark text-light">
                                            <i class="fa fa-plus-square" aria-hidden="true"></i> Update Stock
                                        </a>
                                        <a href="{{ route('deduct.stock', $item->id) }}" class="btn btn-info">
                                            <i class="fa fa-plus-square" aria-hidden="true"></i> Stock Deduct
                                        </a>
                                        <a href="{{ route('delete.purchase', $item->id) }}" class="btn btn-danger"
                                            id="delete" title="Purchase Delete">
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
