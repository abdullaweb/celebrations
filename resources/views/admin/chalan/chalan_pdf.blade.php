@extends('admin.admin_master')
@section('admin')
    <style>
        .row.invoice-wrapper.mb-5 {
            height: 100vh;
            position: relative;
        }

        .col-12.invoice_page {
            position: absolute;
            bottom: 3vh;
        }

        /* table.invoice_table tbody,
                    td,
                    tfoot,
                    th,
                    thead,
                    tr {
                        border-width: 1px !important;
                        padding: 8px;
                    } */

        table.invoice_table tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-width: 1px !important;
            padding: 8px;
        }

        table.amount_section tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            padding: 2px;
        }

        table.invoice_table th,
        table.amount_section th {
            font-weight: 600 !important;
            font-size: 18px;
        }

        .card.invoice-page {
            /* position: relative; */
            height: 100%;
        }
        td.des{
            text-align: left !important;
        }
        td.qty{
            text-align: right !important;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Invoice</h4>

                        {{-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div> --}}
                        <div class="d-print-none">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i
                                        class="fa fa-print"></i> Print</a>
                                {{-- <a href="#"
                                    class="btn btn-primary waves-effect waves-light ms-2">Download</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row invoice-wrapper mb-5">
            <div class="col-12">
                <div class="card invoice-page">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                </div>
                                @php
                                    $payments = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                                @endphp
                                <div class="row">
                                    <div class="col-6 mt-4">
                                        <h5>
                                            Date:
                                            <strong>{{ date('d-m-Y', strtotime($invoice->date)) }}</strong>
                                            <br>
                                        </h5>
                                        <h5> Delivery Chalan No:
                                            <strong> {{ $invoice->invoice_no_gen }}</strong>
                                        </h5>
                                        <br>

                                        <strong>{{ $payments['company']['name'] }}</strong><br>
                                        {{ $payments['company']['address'] }}<br>
                                        {{ $payments['company']['phone'] }}
                                        </address>
                                    </div>
                                    <div class="col-6 mt-4 text-end">
                                        <address>
                                            {{-- <strong>Invoice Date:</strong><br>
                                                {{ date('d-m-Y', strtotime($invoice->date)) }}<br><br> --}}
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-size-16"><strong>Order summary</strong></h3>
                                    </div>
                                    <div class="">
                                        <table class="invoice_table text-center p-2" border="1" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Sl.No</th>
                                                    <th class="des">Description</th>
                                                    <th width="10%">Size</th>
                                                    <th width="10%">Qty</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $total_qty = '0';
                                                @endphp
                                                @foreach ($invoice['invoice_details'] as $key => $details)
                                                    <tr>
                                                        <td width="10%">{{ $key + 1 }}</td>
                                                        <td class="text-center des">{{ $details['sub_category']['name'] }}</td>
                                                       @if ($details->size_width != null && $details->size_width != null)
                                                            <td class="text-center">{{ $details->size_width }} x
                                                                {{ $details->size_length }}</td>
                                                        @elseif ($details->size != null)
                                                            <td>{{ $details->size }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        <td class="text-center qty">{{ $details->selling_qty }}  {{ $details['sub_category']['unit']['name'] }}</td>
                                                    </tr>

                                                    @php
                                                        $total_qty += $details->selling_qty;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                            <tr>
                                                  
                                            </tr>
                                        </table>
                                        <table class="amount_section mt-2" border="1" style="float: right;"
                                            width="20%">
                                            <thead>
                                                <tr>
                                                    <th width="10%">Total</th>
                                                    <td class="text-center qty" width="10%">{{ $total_qty }}/-</td>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-12 invoice_page">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted"> Received By ({{ $payments['company']['name'] }})
                                    </p>
                                    <h5><small class="fs-6">For</small> Rupa Printing House</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
