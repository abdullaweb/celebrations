@extends('admin.admin_master')
@section('admin')
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        .row.invoice-wrapper.mb-5 {
            height: 1000px;
            position: relative;
        }

        .col-12.invoice_page {
            position: absolute;
            bottom: 0vh;
        }

        table.invoice_table td,
        table.invoice_table th,
        address {
            color: #000 !important;
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
            font-weight: 800 !important;
            font-size: 12px;
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

        .register-info > h6, .register-info > h5, .govt-info h5, .mushak h5 {
            font-size: 12px;
        }
        .purchaser-info>h6 {
            font-size: 14px;
        }

        .foot-content h5 {
            font-size: 14px;
        }
        .invoice_page.content{
            font-size: 12px;
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

            <div class="row invoice-wrapper mb-5">
                <div class="col-12">
                    <div class="card invoice-page">
                        <div class="card-body">
                            @php
                                $payments = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                            @endphp

                            {{-- Head Info --}}
                            <div class="row mt-2">
                                <div class="col-12 text-center govt-info">
                                    <h5>
                                        Government of the People's Republic of Bangladesh
                                    </h5>
                                    <h5>
                                        National Board of Revenue
                                    </h5>
                                </div>
                                <div class="col-12">
                                    <div class="mushak text-end">
                                        <h5 class="border border-dark border-2 d-inline">
                                            MUSHAK 6.3
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            {{-- Information --}}
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 text-center mb-3 register-info">
                                            <h5>
                                                Tax Challan
                                            </h5>
                                            <h6>
                                                [See Clauses (C) and (f) of Sub-Rule (1) of Rule 40]
                                            </h6>
                                            <h6>
                                                Name of Registered Person: <strong>Rupa Printing Press</strong>
                                            </h6>
                                            <h6>
                                                BIN of Registered Person: <strong>002637647-0401</strong>
                                            </h6>
                                            <h6>
                                                Challan Issuing Address: <strong>448, Bohumukhi Khudro Kutir Shilpo Market,
                                                    Section-10,
                                                    <br> Mirpur PS, Dhaka 1216, Bangladesh</strong>
                                            </h6>
                                        </div>

                                        <div class="col-6 purchaser-info">
                                            <h6>
                                                Name of Purchaser: <strong>
                                                    {{ $payments['company']['name'] }}
                                                </strong>
                                            </h6>
                                            <h6>
                                                BIN of Purchaser: <strong>{{ $payments['company']['bin_number'] }}</strong>
                                            </h6>
                                            <h6>
                                                Destination of Supply:
                                                <strong>{{ $payments['company']['address'] }}</strong>
                                            </h6>
                                        </div>
                                        <div class="col-2">

                                        </div>
                                        <div class="col-4 purchaser-info">
                                            <h6>
                                                Invoice No: <strong> {{ $vat_chalan->invoice_no }}</strong>
                                            </h6>
                                            <h6>
                                                Date of Issue: <strong>
                                                    {{ date('d-m-Y', strtotime($invoice->date)) }}</strong>
                                            </h6>
                                            <h6>
                                                Time of Issue: <strong>
                                                    {{ date('h:i A', strtotime($invoice->created_at)) }}</strong>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Main Form --}}
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="">
                                            <table class="invoice_table text-center p-2" border="1" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>S.L NO</th>
                                                        <th class="10%">Details Of Supply</th>
                                                        <th width="2%">Unit</th>
                                                        <th width="5%">Actual Qty</th>
                                                        <th width="5%">Rate Without Tax</th>
                                                        <th width="7%">Total Without Tax</th>
                                                        <th width="2%">
                                                            SD(%)
                                                        </th>
                                                        <th width="2%">
                                                            Amount of SD(%)
                                                        </th>
                                                        <th width="2%">VAT(%)</th>
                                                        <th width="3%">Amount of VAT</th>
                                                        <th width="10%">
                                                            Total
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $total_sum = '0';
                                                        $total_qty = '0';
                                                        $amount_of_vat = '0';
                                                        $total_qty = '0';
                                                        $grand_total = '0';
                                                    @endphp
                                                    @php
                                                        $count = count($invoice['invoice_details']);
                                                    @endphp
                                                    @foreach ($invoice['invoice_details'] as $key => $details)
                                                        <tr>

                                                            <td>{{ $key + 1 }}</td>
                                                            <td class="text-center des">
                                                                {{ $details['sub_category']['name'] }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $details['sub_category']['unit']['name'] }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ number_format($details->selling_qty) }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $details->unit_price }}/-
                                                            </td>
                                                            <td class="text-center">
                                                                {{ number_format($details->selling_price) }}/-
                                                            </td>
                                                            <td class="text-center">
                                                                -
                                                            </td>
                                                            <td class="text-center">
                                                                -
                                                            </td>

                                                            @php
                                                                $vat = ($payments->sub_total * $payments->vat) / 100;
                                                                $tax = ($payments->sub_total * $payments->tax) / 100;
                                                                $total_sum += $details->selling_price;
                                                                $total_qty += $details->selling_qty;
                                                                $amount_of_vat += $payments->vat_amount;
                                                                $grand_total += $payments->total_amount;

                                                                $vat_amount =
                                                                    ($details->selling_price * $payments->vat_tax) /
                                                                    100;
                                                                $subTotal = $details->selling_price + $vat_amount;
                                                            @endphp
                                                            <td class="text-center">
                                                                {{ $payments->vat_tax }}%
                                                            </td>
                                                            <td class="text-center">
                                                                {{ number_format(round($vat_amount)) }}/-
                                                            </td>

                                                            <td class="text-center">
                                                                {{ number_format($subTotal) }}/-
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td>Total</td>
                                                        <td></td>
                                                        <td>{{ number_format($total_qty) }}</td>
                                                        <td></td>
                                                        <td>{{ number_format($total_sum) }}/-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td></td>
                                                        <td>{{ number_format(round($payments->vat_amount)) }}/-</td>
                                                        <td>{{ number_format($payments->total_amount) }}/</td>
                                                    </tr>
                                                </tbody>
                                                <tr>

                                                </tr>
                                            </table>
                                        </div>
                                        <div class="foot-content mt-5 mb-4">
                                            <h5>
                                                Name of organization Officer-in-charge: <strong>Rony Kumer Saha</strong>
                                            </h5>
                                            <h5>
                                                Designation: <strong>Manager</strong>
                                            </h5>
                                            <h5>
                                                Seal:
                                            </h5>

                                            {{-- <div class="info">
                                                <p class="text-dark mt-5">
                                                    * Applicable to the supplies made to the withholding entity only and in
                                                    that
                                                    case it
                                                    will be used as combined tax invoice cum withholding certificate.
                                                </p>
                                                <p class="text-dark">
                                                    * Value except all kinds of Tax
                                                </p>
                                            </div> --}}
                                        </div>

                                    </div>



                                </div>

                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-12 invoice_page content">
                                    <div class="">
                                        <p class="text-dark mb-0">
                                            * Applicable to the supplies made to the withholding entity only and in
                                            that
                                            case it
                                            will be used as combined tax invoice cum withholding certificate.
                                        </p>
                                        <p class="text-dark">
                                            * Value except all kinds of Tax
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid -->

        </div>
        <!-- end page title -->







    </div>
    <!-- End Page-content -->
@endsection
