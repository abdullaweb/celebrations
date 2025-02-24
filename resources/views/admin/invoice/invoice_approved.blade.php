@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Invoice Approved</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('invoice.pending.list') }}">
                    <button class="btn btn-info"><i class="fa fa-list" aria-hidden="true"> Pending Invoice List </i></button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->

        <div class="container">
            <div class="main-body">

                @php
                    $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                @endphp
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Invoice No: #{{ $invoice->invoice_no }} - {{ date('d-m-Y', strtotime($invoice->date)) }}
                                </h4>
                                <table class="table table-striped table-dark table-responsive">
                                    <tbody>
                                        <tr>
                                            <td scope="row">
                                                <p>Customer Info</p>
                                            </td>
                                            <td>
                                                <p>Name: <strong
                                                        class="fw-bolder">{{ $payment['customer']['name'] }}</strong></p>
                                            </td>
                                            <td>
                                                <p>Email: <strong>{{ $payment['customer']['email'] }}</strong></p>
                                            </td>
                                            <td>
                                                <p>Mobile:<strong>{{ $payment['customer']['mobile_no'] }}</strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row"></td>
                                            <td colspan="3">
                                                <p>Description <strong>{{ $invoice->description }}</strong></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <form action="{{ route('approval.store', $invoice->id) }}" method="POST">
                                    @csrf
                                    <table class="table-dark table-responsive table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sl</th>
                                                <th class="text-center">Caregory</th>
                                                <th class="text-center">Product Name</th>
                                                <th class="text-center bg-warning">Current Stock</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Unit Price</th>
                                                <th class="text-center">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_sum = 0;
                                            @endphp
                                            @foreach ($invoice['invoice_details'] as $key => $details)
                                                <tr>

                                                    <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                                    <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                                    <input type="hidden" name="selling_qty[{{ $details->id }}]" value="{{ $details->selling_qty }}">

                                                    <td class="text-center">{{ $key+1 }}</td>
                                                    <td class="text-center">{{ $details['category']['name'] }}</td>
                                                    <td class="text-center">{{ $details['product']['name'] }}</td>
                                                    <td class="text-center bg-warning">{{ $details['product']['quantity'] }}</td>
                                                    <td class="text-center">{{ $details->selling_qty }}</td>
                                                    <td class="text-center">{{ $details->unit_price }}</td>
                                                    <td class="text-center">{{ $details->selling_price }}</td>
                                                </tr>
                                                @php
                                                    $total_sum += $details->selling_price;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="6">Subtotal</td>
                                                <td class="text-center">{{ $total_sum }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">Discount Amount</td>
                                                <td class="text-center">{{ $payment->discount_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">Paid Amount</td>
                                                <td class="text-center">{{ $payment->paid_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">Due Amount</td>
                                                <td class="text-center">{{ $payment->due_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">Grand Total</td>
                                                <td class="text-center">{{ $payment->total_amount }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <button class="btn btn-info">Invoice Approve</button>
                                </form>

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
