@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Customer</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.company') }}">
                    <button class="btn btn-info">Add Customer</button>
                </a>
            </h6>
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
                                    <th>Customer ID</th>
                                    <th>Phone</th>
                                    <th>Due Amount</th>
                                    <th>Advance Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Customer ID</th>
                                    <th>Phone</th>
                                    <th>Due Amount</th>
                                    <th>Advance Amount</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allData as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {{ $item->company_id }}
                                        </td>
                                        <td>
                                            {{ $item->phone }}
                                        </td>
                                        <td>
                                            {{ number_format($item->total_due) }}
                                        </td>
                                        <td>
                                            {{ number_format($item->total_deposit) }}
                                        </td>
                                        <td>
                                            @if (Auth::user()->can('company.edit'))
                                                <a style="margin-left: 5px;" href="{{ route('edit.company', $item->id) }}"
                                                    class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif

                                            <a title="Add Advance" style="margin-left: 5px;" data-id="{{ $item->id }}"
                                                data-deposit="{{ $item->total_deposit }}" class="btn btn-info advanceBtn"
                                                data-bs-toggle="modal" data-bs-target="#advanceModal">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Advance
                                            </a>


                                             @if (Auth::user()->can('corporate.bill.list'))
                                                <a style="margin-left: 5px;" href="{{ route('company.bill', $item->id) }}"
                                                    class="btn btn-dark" title="Company Bill">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    View Bill
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

         <!-- Account Advance Modal -->
         <div class="modal fade" id="advanceModal" tabindex="-1" aria-labelledby="advanceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="advanceModalLabel">Add Advance Amount</h5>
                        <button type="button" class="btn-close closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="custom-validation" novalidate="" id="advanceForm" autocomplete="off">
                            <div class="errorMsgContainer mb-2"></div>
                            <input type="hidden" id="customer_id" name="customer_id">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="due_amount">Previous Advance</label>
                                        <input type="digit" id="previous_amount" name="previous_amount" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="advance_amount">Enter Advance Amount</label>
                                        <input type="digit" id="advance_amount" name="advance_amount" class="form-control"
                                            required="" data-parsley-trigger="keyup" data-parsley-type="number"
                                            data-parsley-validation-threshold="0" min="0"
                                            data-parsley-type-message="Input must be positive number"
                                            data-parsley-required-message="Amount is required"
                                            placeholder="Enter Advance Amount">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" id="payment_note" name="payment_note"
                                            placeholder="Enter Payment Note" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" id="date" name="date" placeholder="Enter Date"
                                            class="form-control date_picker" required=""
                                            data-parsley-required-message="Date is required">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <div>
                                    <button type="submit"
                                        class="btn btn-info waves-effect waves-light me-1 add-customer-advance">
                                        Save Changes
                                    </button>
                                    <button type="button" class="btn btn-secondary closeBtn" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                // show edit value in update form
                $(document).on('click', '.advanceBtn', function() {
                    let id = $(this).data('id');
                    let advance = $(this).data('deposit') || 0;

                    $('#customer_id').val(id);
                    $('#previous_amount').val(advance);
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                // add advance amount
                $(document).on('click', '.add-customer-advance', function(e) {
                    e.preventDefault();
                    let previous_amount = $("#previous_amount").val();
                    let customer_id = $('#customer_id').val();
                    let date = $("#date").val();
                    let bank_id = $("#bank_id").val();
                    let advance_amount = $("#advance_amount").val();
                    let payment_note = $("#payment_note").val();
                    $.ajax({
                        url: "{{ route('customer.advance.payment') }}",
                        method: 'post',
                        data: {
                            customer_id: customer_id,
                            previous_amount: previous_amount,
                            advance_amount: advance_amount,
                            date: date,
                            payment_note: payment_note,
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                $("#advanceModal").modal('hide');
                                $("#advanceForm")[0].reset();
                                $(".errorMsgContainer").html("");
                                $(".table").load(location.href + ' .card');


                                Command: toastr["info"](
                                    "Advance Added Successfully!"
                                )

                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                            }
                        },
                        error: function(err) {
                            console.log(err);
                            let error = err.responseJSON;
                            console.log(error);
                            $.each(error.errors, function(index, value) {
                                $(".errorMsgContainer").append(
                                    '<span class="text-danger">' + value + '</span>' +
                                    '<br>');
                            });

                            $(document).on('click', '.closeBtn', function(e) {
                                $(".errorMsgContainer").html("");
                            });
                        }
                    });
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    @endsection
