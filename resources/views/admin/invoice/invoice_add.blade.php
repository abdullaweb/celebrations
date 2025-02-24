@extends('admin.admin_master')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Invoice </h4><br><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">VAT No</label>
                                        <input type="text" class="form-control" name="vat_invoice_no" id="vat_invoice_no"
                                            value="{{ $vat_invoice_no }}" "Enter VAT Number" required readonly>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Inv No</label>
                                        <input class="form-control" type="text" name="invoice_no"
                                            value="{{ $invoice_no }}" id="invoice_no" readonly style="background: #ddd;">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Date</label>
                                        <input type="date" value="{{ $date }}" class="form-control"
                                            name="date" id="date">
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Bill Number</label>
                                        <input type="text" class="form-control" name="po_number" id="po_number"
                                            placeholder="Enter Bill Number" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Customer
                                            Name</label>
                                        <select name="company_id" id="company_id" class="form-control form-select select2">
                                            <option value="">Select Customer Name</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Category
                                            Name</label>
                                        <select name="category_id" id="category_id"
                                            class="form-control form-select select2">
                                            <option value="">Select Category Name</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Product
                                            Name</label>
                                        <select name="sub_cat_id" id="sub_cat_id" class="form-control form-select select2">
                                            <option selected value="">Select Product</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="md-3" id="default_addBtn">
                                        <label for="example-text-input" class="col-sm-12 col-form-label mt-4"></label>
                                        <i class="btn btn-secondary btn-rounded wave-effect wave-light fas fa-plus-circle"
                                            id="addEventMore">
                                            Add
                                            More</i>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3" id="new_company" style="display: none;">
                                <div class="form-group col-md-3">
                                    <input type="text" name="name" id="name" placeholder="Customer Name"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="tel" name="mobile_no" id="mobile_no" placeholder="Customer Mobile No"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="email" name="email" id="email" placeholder="Customer Email"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="md-3">
                                        <i class="btn btn-secondary btn-rounded wave-effect wave-light fas fa-plus-circle"
                                            id="addEventMore">
                                            Add
                                            More</i>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="card-body">
                            <form method="POST" action="{{ route('invoice.store') }}" novalidate="" id="invoiceForm"
                                autocomplete="off">
                                @csrf
                                <table class="table table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Size</th>
                                            <th width="7%">Quantity</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="15%">Total Price</th>
                                            <th width="7%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addRow" class="addRow">

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="6">Sub Total</td>
                                            <td width="12%">
                                                <input type="number" name="sub_total" id="sub_total"
                                                    class="form-control sub_total" placeholder="Sub Total" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Discount Amount</td>
                                            <td width="12%">
                                                <input type="number" name="discount_amount" id="discount_amount"
                                                    class="form-control discount_amount" placeholder="Discount Amount">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Vat Amount</td>
                                            <td width="12%">
                                                <input type="number" name="vat_amount" id="vat_amount"
                                                    class="form-control vat_amount" placeholder="Vat Amount"
                                                    value="0" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Grand Total</td>
                                            <td>
                                                <input type="text" name="estimated_amount" id="estimated_amount"
                                                    class="form-control estimated_amount" style="background:#ddd;"
                                                    readonly value="0">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <div class="row mb-3">
                                    <div class="col-md-3" id="vat_tax_col">
                                        <select name="vat_tax_field" id="vat_tax_field" class="form-control" required
                                            data-parsley-required-message="Vat field is required">
                                            <option value="" selected disabled>Select Vat Tax</option>
                                            @foreach ($taxes as $tax)
                                                <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                                            @endforeach
                                            <option value="0">Without Vat/Tax</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="paid_status" id="paid_status" required
                                            data-parsley-required-message="Paid Status is required">
                                            <option value="" selected disabled>Select Paid Status</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="full_due">Full Due</option>
                                            <option value="partial_paid">Partial Paid</option>
                                        </select>
                                        <input type="text" placeholder="Enter Paid Amount" class="form-control"
                                            name="paid_amount" id="paid_amount" style="display:none;">
                                    </div>
                                    <div class="col-md-3" id="paid_source_col" style="display: none;">
                                        <select class="form-control" name="paid_source" id="paid_source">
                                            <option value="" selected disabled>Select Payment Status</option>
                                            <option value="0">Advance Balance</option>
                                            <option value="cash">Cash</option>
                                            <option value="check">Check</option>
                                            <option value="online-banking">Online Banking</option>
                                        </select>
                                        <input type="text" placeholder="Check OR Online Banking Name"
                                            class="form-control" name="check_or_banking" id="check_or_banking"
                                            style="display:none;">
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-info" id="storeButton">Invoice Store</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>



    <script>
        function taxUpdate(tax_id) {
            let taxId = tax_id;
            if (taxId != '0') {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('get.tax.percentage', '') }}" + "/" + taxId,
                    success: function(data) {
                        console.log('data', data);
                        let sub_total = $('#sub_total').val();
                        let discount_amount = $('#discount_amount').val();

                        let after_discount = parseFloat(sub_total) - discount_amount;
                        let tax_amount = Math.round((after_discount * data) / 100);
                        let grandTotal = after_discount + parseFloat(tax_amount);
                        $('#estimated_amount').val(grandTotal);
                        $('#vat_amount').val(tax_amount);
                    }
                });
            } else {
                let sub_total = $('#sub_total').val();
                let discount_amount = 0;
                if (discount_amount != null) {
                    discount_amount += $('#discount_amount').val();
                } else {
                    discount_amount += 0;
                }

                let amount = 0;
                $('#vat_amount').val(amount);
                let newTotal = parseFloat(sub_total) - parseFloat(discount_amount);
                $('#estimated_amount').val(newTotal);

            }
        }
    </script>

    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date" value="@{{ date }}">
            <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
            <input type="hidden" name="vat_invoice_no" value="@{{ vat_invoice_no }}">
            <input type="hidden" name="po_number" value="@{{ po_number }}">
            <td hidden>
                <input type="hidden" name="company_id[]" value="@{{ company_id }}">
                @{{ company_name }}
            </td>
            <td hidden>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                <span class="cat_name">@{{ category_name }}</span>
            </td>
            <td width="20%">
                <input type="hidden" name="sub_cat_id[]" value="@{{ sub_cat_id }}">
                     <span class="sub_cat_name">@{{ sub_cat_name }}</span>
            </td>
            <td>
                <input type="text" class="form-control" placeholder="Write Description"  name="description[]" autocomplete="off">
            </td>
            <td width="8%">
                <input type="text"  class="form-control size" id="size" placeholder="Size" name="size[]" autocomplete="off">
            </td>
            <td width="4%">
                <input type="digit" class="form-control selling_qty text-right" required="" data-parsley-required-message="Qty is required"   name="selling_qty[]"
                    value="" autocomplete="off">
            </td>
            <td width="10%">
                <input type="digit" class="form-control unit_price text-right" required="" data-parsley-required-message="Uiit Price is required"  name="unit_price[]=" value="" autocomplete="off">
            </td>

            <td>
                <input type="digit"  class="form-control selling_price text-right" required="" data-parsley-required-message="Selling Price is required" name="selling_price[]"
                    value="0" readonly>
            </td>
            <td>
                <i class="btn btn-danger btn-sm fas fa-window-close" id="removeEventMore"></i>
            </td>
        </tr>
    </script>


    {{--  add more purchase   --}}
    <script>
        $(document).ready(function() {
            $(document).on("click", "#addEventMore", function() {

                let date = $("#date").val();
                let invoice_no = $("#invoice_no").val();
                let vat_invoice_no = $("#vat_invoice_no").val();
                let po_number = $("#po_number").val();
                let company_id = $("#company_id").val();
                let company_name = $("#company_id").find('option:selected').text();
                let category_id = $("#category_id").val();
                let category_name = $("#category_id").find('option:selected').text();
                let sub_cat_id = $("#sub_cat_id").val();
                let sub_cat_name = $("#sub_cat_id").find('option:selected').text();

                console.log(po_number);
                if (date == '') {
                    $.notify("Date is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                if (po_number == '') {
                    $.notify("Bill Number is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                
                if (company_id == '') {
                    $.notify("Company is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                
                if (category_id == '') {
                    $.notify("Category is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (sub_cat_id == '') {
                    $.notify("Sub Category is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                let source = $("#document-template").html();
                let template = Handlebars.compile(source);

                let data = {
                    date: date,
                    invoice_no: invoice_no,
                    vat_invoice_no: vat_invoice_no,
                    po_number: po_number,
                    company_id: company_id,
                    company_name: company_name,
                    category_id: category_id,
                    category_name: category_name,
                    sub_cat_id: sub_cat_id,
                    sub_cat_name: sub_cat_name,
                };
                let html = template(data);
                $("#addRow").append(html);
            });


            $(document).on("click", "#removeEventMore", function() {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });


            $(document).on("keyup click", ".unit_price,.selling_qty", function() {
                let category_name_check = $("#category_id").find('option:selected').text();
                let cat_name = category_name_check.trim();



                let unit_price = $(this).closest("tr").find('input.unit_price').val();
                let selling_qty = $(this).closest("tr").find('input.selling_qty').val();
                console.log(unit_price, selling_qty);
                let total = Math.round(unit_price * selling_qty);
                $(this).closest("tr").find('input.selling_price').val(total);
                $("#discount_amount").trigger('keyup');


                if (selling_qty == 'MM') {
                    let total = Math.round(unit_price * 1);
                    $(this).closest("tr").find('input.selling_price').val(total);
                    $("#discount_amount").trigger('keyup');
                }

            });

            $(document).on('keyup', '#discount_amount', function() {
                totalAmountPrice();
            });

            //  calculate sum amount for invoice

            function totalAmountPrice() {
                let sum = 0;
                let subTotal = 0;
                $('.selling_price').each(function() {
                    let value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                        subTotal += parseFloat(value);
                    }
                });
                $("#sub_total").val(subTotal);


                let taxId = $('#vat_tax_field').val();
                if (taxId == null) {
                    let noTax = 0;
                    taxUpdate(noTax);
                } else {
                    taxUpdate(taxId);
                }
                $vat_amount = $('#vat_amount').val();


                let discount_amount = parseFloat($('#discount_amount').val());
                if (!isNaN(discount_amount) && discount_amount.length != 0) {
                    sum -= parseFloat(discount_amount);
                }

                let includeVat = sum + parseFloat($vat_amount);
                $("#estimated_amount").val(includeVat);
            }

        });
    </script>



    {{--  dropdown menu select  --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#paid_status').on('change', function() {
                let paidStatus = $(this).val();
                console.log('paidSource', paidStatus);
                if (paidStatus) {
                    $('#paid_source_col').show();
                }

                if (paidStatus == 'partial_paid') {
                    $('#paid_amount').show();
                } else {
                    $('#paid_amount').hide();
                }

                if (paidStatus == 'full_due') {
                    $('#paid_source_col').hide();
                }

            });


            $('#paid_source').on('change', function() {
                let paidSource = $(this).val();
                console.log('paidSource', paidSource);
                if (paidSource == 'check' || paidSource == 'online-banking') {
                    $('#check_or_banking').show();
                } else {
                    $('#check_or_banking').hide();
                }
            });


            $('#vat_tax_field').on('change', function() {
                let taxId = $(this).val();
                taxUpdate(taxId);
            });

            // new customer
            $('#company_id').on('change', function() {
                let compnayId = $(this).val();
                console.log(compnayId);
                if (compnayId == '0') {
                    $('#new_company').show();
                    $('#default_addBtn').hide();
                } else {
                    $('#new_company').hide();
                    $('#default_addBtn').show();
                }
            });
        });
    </script>


    {{-- get product name --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#category_id').on('change', function() {
                let categoryId = $(this).val();
                let catName = $("#category_id").find('option:selected').text();
                let checkCat = catName.trim();

                console.log('cat', checkCat);



                $.ajax({
                    url: '{{ route('get.sub.cat') }}?category_id=' + categoryId,
                    type: 'GET',
                    success: function(data) {
                        let html = '<option value="">Select Sub Category </option>';
                        $.each(data, function(key, value) {
                            html += '<option value=" ' + value.id + ' "> ' +
                                value.name + '</option>';
                        });
                        $("#sub_cat_id").html(html);
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('backend/assets/libs/parsleyjs/parsley.min.js') }}"></script>

    <script>
        $('#invoiceForm').parsley();
    </script>
@endsection
