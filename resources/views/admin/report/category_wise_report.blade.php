@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Begin Page Content -->
    <div class="page-content">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-12 py-3 d-flex justify-content-center align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary text-center">Category Wise Daily Sales Report</h6>
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{-- <a href="{{ route('add.opening.balance') }}">
                                <button class="btn btn-info">Add Balance</button>
                            </a> --}}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th colspan="2">Date</th>
                                <th colspan="{{ count($categories) }}">Category</th>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>Bill No</td>
                                @foreach ($categories as $key => $item)
                                    <td>{{ $item->name }}</td>
                                @endforeach
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="text-center">
                                <th colspan="2">Date</th>
                                <th colspan="{{ count($categories) }}">Category</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($invoice as $key => $item)
                                <tr>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->invoice_no_gen }}</td>

                                    @php
                                        $invoice_details = App\Models\InvoiceDetail::where('invoice_id', $item->id)->get();
                                    @endphp

                                    @foreach ($invoice_details as $invoice_info)
                                        @if ($item->id == $invoice_info->invoice_id)
                                            @foreach ($categories as $key => $cat)
                                                @if ($invoice_info->category_id == $cat->id)
                                                    <td>
                                                        {{ $invoice_info['category']['name'] }}
                                                        -
                                                        {{ $invoice_info->selling_price }}
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('get.cat.report') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" placeholder="Enter Date" class="form-control ml-2 date_picker"
                            name="start_date" id="start_date" required>
                        <input type="text" placeholder="Enter Date" class="form-control ml-2 date_picker" name="end_date"
                            id="end_date" required>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="" selected disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            {{-- <tr class="text-center">
                                <th colspan="2">Date</th>
                                <th colspan="{{ count($categories) }}">Category</th>
                            </tr> --}}
                            <tr class="text-center">
                                <th>Date</th>
                                <th>Bill No</th>
                                <th>Category</th>
                                <th>Amount</th>
                                {{-- @foreach ($categories as $key => $item)
                                    <td>{{ $item->name }}</td>
                                @endforeach --}}
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
                            @php
                                $cat_info = App\Models\InvoiceDetail::get();
                            @endphp
                            @foreach ($cat_info as $key => $info)
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
