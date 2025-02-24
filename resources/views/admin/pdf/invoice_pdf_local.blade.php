@extends('admin.admin_master')
@section('admin')
    <style>
        .row.invoice-wrapper.mb-5 {
            height: 100vh;
            position: relative;
        }

        .col-12.invoice_page {
            position: absolute;
            bottom: 6vh;
        }
        table.invoice_table td, table.invoice_table th, address{
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
            font-weight: 600 !important;
            font-size: 18px;
        }

        .card.invoice-page {
            /* position: relative; */
            height: 100%;
        }



        ul.description {
            margin: 0 0 0 5px;
            padding: 0 0 0 10px;
        }

        table.product_table {
            border: gray;
            border-right-color: gray;
        }

        td.des{
            text-align: left !important;
        }
        td.qty{
            text-align: right !important;
        }
        
        tr.custom-border>td:first-child {
            border-color: transparent;
        }

        tr.custom-border>td:nth-child(2) {
            border-left-color: transparent;
            border-bottom-color: transparent;
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
                        <div class="row">
                            <div class="col-12 pt-3">
                                <div class="invoice-title">
                                </div>
                                @php
                                    $payments = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                                @endphp
                                <div class="row">
                                    <div class="col-6 mt-4">
                                        <address>
                                            <strong>To</strong>
                                            <br>
                                            <h5 class="mb-0">{{ $payments['company']['name'] }}</h5>
                                            {{ $payments['company']['address'] }}<br>
                                        </address>

                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div>
                                    <h5> Bill No:
                                        <strong> {{ $invoice->invoice_no_gen }}</strong>
                                    </h5>
                                    <div class="py-2">
                                        <h3 class="font-size-16"><strong>Date:
                                                {{ date('d-m-Y', strtotime($invoice->date)) }}</strong></h3>
                                    </div>
                                    <div class="">
                                        <table class="invoice_table p-2" border="1" width="100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="2%">Sl.No</th>
                                                    <th colspan="3" width="45%">Description</th>
                                                    <th width="10%">Size</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="10%">Rate</th>
                                                    <th width="10%">Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($data as $key => $check)
                                                    <tr>
                                                        @php
                                                            $product_name = $check[0]->product_name;
                                                        @endphp
                                                        <td class="text-center">{{ $i++ }}</td>
                                                        <td width="20%">{{ $product_name }}</td>
                                                        <td colspan="6">
                                                            <table width="100%" class="product_table">
                                                                @php
                                                                    $all_product = App\Models\InvoiceDetail::where('product_name', $product_name)
                                                                        ->where('invoice_id', $invoice->id)
                                                                        ->get();
                                                                @endphp
                                                                @foreach ($all_product as $item)
                                                                    <tr>
                                                                        <td class="cat_td py-2" width="25%">
                                                                            <ul class="description">
                                                                                <li>
                                                                                    {{ $item['category']['name'] }}
                                                                                    @if ($item->sub_cat_id != null)
                                                                                        -
                                                                                        {{ $item['sub_category']['name'] }} 
                                                                                        
                                                                                        @if ($item->description != null)
                                                                                        - {{ $item->description }}
                                                                                        @else
                                                                                        @endif
                                                                                    @else
                                                                                    @endif
                                                                                </li>
                                                                            </ul>
                                                                            </h6>
                                                                        </td>
                                                                        @if ($item->size_width != null && $item->size_length != null)
                                                                            <td width="10%" class="text-center">
                                                                                {{ $item->size_width }}
                                                                                x
                                                                                {{ $item->size_length }}
                                                                            </td>
                                                                        @elseif ($item->size_width == null && $item->size_length == null)
                                                                            <td class="text-center" width="10%"></td>
                                                                        @elseif($item->size_width != null)
                                                                            <td class="text-center" width="10%">
                                                                                {{ $item->size_width }}
                                                                            </td>
                                                                        @elseif($item->size_length != null)
                                                                            <td class="text-center" width="10%">
                                                                                {{ $item->size_length }} </td>
                                                                        @endif

                                                                        <td class="text-center" width="10%">
                                                                            {{ number_format($item->selling_qty) }} {{ $item['sub_category']['unit']['name'] }}
                                                                        </td>
                                                                        <td class="text-center" width="10%">
                                                                            {{ $item->unit_price }}/-
                                                                        </td>
                                                                        <td class="text-center" width="10%">
                                                                            {{ number_format($item->selling_price) }}/-</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td colspan="5">
                                                        @php
                                                            $in_word = numberTowords($payments->total_amount);
                                                        @endphp
                                                         <strong>In Word : </strong> {{ $in_word }}
                                                    </td>
                                                    <td>Total</td>
                                                    <td class="text-center">{{ number_format($payments->total_amount) }}/-</td>
                                                </tr>
                                                <tr class="custom-border">
                                                    <td></td>
                                                    <td colspan="5">
                                                    </td>
                                                    <td>Paid Amount</td>
                                                    <td class="text-center">{{ number_format($payments->paid_amount) }}/-</td>
                                                </tr>
                                                @if ($payments->due_amount != '0')
                                                    <tr class="custom-border">
                                                        <td></td>
                                                        <td colspan="5">

                                                        </td>
                                                        <td>Due Amount</td>
                                                        <td class="text-center">{{ number_format($payments->due_amount) }}/-</td>
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
                                    <p class="text-dark"> Received By ({{ $payments['company']['name'] }})
                                    </p>
                                    <h5><small class="fs-6">For</small> Rupa Printing Press</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <script>
        function getNextChar(char) {
            return String.fromCharCode(char.charCodeAt(0) + 1);
        }
    </script>
    <?php
    // Create a function for converting the amount in words
    function numberTowords(float $amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = [];
        $change_words = [0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'];
        $here_digits = ['', 'Hundred', 'Thousand', 'Lakh', 'Crore'];
        while ($x < $count_length) {
            $get_divider = $x == 2 ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
                $add_plural = ($counter = count($string)) && $amount > 9 ? 's' : null;
                $amt_hundred = $counter == 1 && $string[0] ? ' and ' : null;
                $string[] =
                    $amount < 21
                        ? $change_words[$amount] .
                            ' ' .
                            $here_digits[$counter] .
                            $add_plural .
                            '
                                                         ' .
                            $amt_hundred
                        : $change_words[floor($amount / 10) * 10] .
                            ' ' .
                            $change_words[$amount % 10] .
                            '
                                                         ' .
                            $here_digits[$counter] .
                            $add_plural .
                            ' ' .
                            $amt_hundred;
            } else {
                $string[] = null;
            }
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise =
            $amount_after_decimal > 0
                ? 'And ' .
                    ($change_words[$amount_after_decimal / 10] .
                        "
                                                   " .
                        $change_words[$amount_after_decimal % 10]) .
                    ' Paise'
                : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . 'Taka Only ' : '') . $get_paise;
    }

    ?>
@endsection
