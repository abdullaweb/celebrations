@extends('admin.admin_master')
@section('admin')
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        .row.invoice-wrapper.mb-5 {
            height: 100vh;
            position: relative;
        }

        .col-12.invoice_page {
            position: absolute;
            bottom: 5vh;
        }

        table.invoice_table td,
        table.invoice_table th,
        address {
            color: #000 !important;
            font-size: 14px;
        }

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
            font-size: 14px;
        }

        .card.invoice-page {
            /* position: relative; */
            height: 100%;
        }

        td.in_word {
            text-align: left;
        }

        td.des {
            text-align: left !important;
        }

        td.qty {
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

                        <div class="d-print-none">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i
                                        class="fa fa-print"></i> Print</a>
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
                        <div class="row" style="margin-top: 80px;">
                            <div class="col-12 pt-3">
                                <div class="invoice-title">
                                </div>
                                @php
                                    $payments = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                                @endphp
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                        <h3 class="font-size-16"><strong>Bill No: #{{ $invoice->po_number }}</strong></h3>
                                        <h3 class="font-size-16"><strong>Date:
                                                {{ date('d-m-Y', strtotime($invoice->date)) }}</strong></h3>
                                        </div>
                                        <address class="mt-2">
                                            <h5 class="mb-0">{{ $payments['company']['name'] ?? '' }}</h5>
                                            <h5> {{ $payments['company']['address'] ?? '' }}</h5>
                                            <h5></h5>
                                        </address>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div>
                                    <div class="">
                                        <table class="invoice_table text-center p-2" border="1" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Sl.No</th>
                                                    <th>Description</th>
                                                    <th width="12%">Qty</th>
                                                    <th width="20%">Rate</th>
                                                    <th width="10%">Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @php
                                                    $count = count($invoice['invoice_details']);
                                                @endphp
                                                @foreach ($invoice['invoice_details'] as $key => $details)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td class="text-center des">
                                                            {{ $details['sub_category']['name'] }}
                                                            {{ $details->description != null ? '- ' . $details->description : '' }}
                                                            {{ $details->size != null ? '- ' . $details->size : '' }}
                                                        </td>

                                                        <td class="text-center">{{ number_format($details->selling_qty) }}
                                                            {{ $details['sub_category']['unit']['name'] ?? '' }}</td>
                                                        <td class="text-center">{{ $details->unit_price }}/-</td>
                                                        <td class="text-center qty">
                                                            {{ number_format($details->selling_price) }}/-
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2" class="in_word">
                                                    </td>
                                                    <td>Sub Total</td>
                                                    <td class="text-center qty">
                                                        {{ number_format($payments->sub_total) }}/-
                                                    </td>
                                                </tr>
                                                

                                                @if ($payments->discount_amount != null)
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="2" class="in_word">
                                                        <td>Discount Amount</th>
                                                        <td class="text-center qty">
                                                            {{ number_format(round($payments->discount_amount)) }}/-</td>
                                                    </tr>
                                                @endif

                                                @if ($payments->vat_tax != null)
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="2" class="in_word">
                                                        <td>Vat ({{ $payments->vat_tax }}%)</th>
                                                        <td class="text-center">
                                                            {{ number_format(round($payments->vat_amount)) }}/-</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2" class="in_word">
                                                    <td>Net Amount</th>
                                                    <td class="text-center qty">{{ number_format(round($payments->sub_total + $payments->vat_amount - $payments->discount_amount)) }}/-</td>
                                                </tr>
                                                @if ($payments->previous_due != 0)
                                                    <tr class="custom-border">
                                                        <td></td>
                                                        <td colspan="2">
                                                        </td>
                                                        <td>Previous Due</td>
                                                        <td class="text-center qty">
                                                            {{ number_format($payments->previous_due) }}/-
                                                        </td>
                                                    </tr>
                                                @endif

                                                <tr class="custom-border">
                                                    <td></td>
                                                    <td colspan="2" class="in_word">
                                                        @php
                                                            $grandTotal =
                                                                $payments->previous_due + $payments->total_amount;
                                                            $dueAmount = $grandTotal - $payments->paid_amount;
                                                            $in_word = numberTowords($dueAmount);
                                                            $in_word_paid = numberTowords($payments->paid_amount);
                                                        @endphp
                                                    </td>
                                                    <td>Grand Total</td>
                                                    <td class="text-center qty">
                                                        {{ number_format($grandTotal) }}/-
                                                    </td>
                                                </tr>
                                                <tr class="custom-border">
                                                    <td></td>
                                                    <td colspan="2">
                                                        @if($dueAmount == '0')
                                                             <i><strong>In Word : </strong> {{ $in_word_paid }}</i>
                                                        @endif
                                                    </td>
                                                    <td>Paid Amount</td>
                                                    <td class="text-center qty">
                                                        {{ number_format($payments->paid_amount) }}/-</td>
                                                </tr>
                                                @if ($dueAmount != '0')
                                                    <tr class="custom-border">
                                                        <td></td>
                                                        <td colspan="2">
                                                            <i><strong>In Word : </strong>{{ $in_word }}</i>
                                                            </td>
                                                        <td>Due Amount</td>
                                                        <td class="text-center qty">
                                                            {{ number_format($dueAmount) }}/-
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-12 invoice_page">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-dark" style="visibility:hidden"> Received By ({{ $payments['company']['name'] }})
                                    </p>
                                    <h5><small class="fs-6">For</small>
                                        <span>Shafi Computer's</span>
                                        <br>
                                        <small style="font-size: 10px;">Developed By <a href="https://web.nebulaitbd.com" target="_blank"
                                                class="text-dark fw-bold">Nebula IT</a> </small>
                                    </h5>
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
