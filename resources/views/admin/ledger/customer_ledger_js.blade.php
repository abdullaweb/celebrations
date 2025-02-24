<script>
    $(document).ready(function() {

        // show edit value in update form
        $(document).on('click', '.paymentBtn', function() {
            let id = $(this).data('id');
            let due = $(this).data('due');
            $('#customer_id').val(id);
            $('#due_amount').val(due);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // add deposit
        $(document).on('click', '.add-customer-payment', function(e) {
            e.preventDefault();
            let due_amount = $("#due_amount").val();
            let customer_id = $('#customer_id').val();
            let date = $("#date").val();
            let bank_id = $("#bank_id").val();
            let paid_amount = $("#amount").val();
            let payment_note = $("#payment_note").val();
            $.ajax({
                url: "{{ route('customer.due.payment') }}",
                method: 'post',
                data: {
                    customer_id: customer_id,
                    bank_id: bank_id,
                    due_amount: due_amount,
                    paid_amount: paid_amount,
                    date: date,
                    payment_note: payment_note,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $("#paymentModal").modal('hide');
                        $("#paymentForm")[0].reset();
                        $(".errorMsgContainer").html("");
                        $(".table").load(location.href + ' .card');


                        Command: toastr["info"](
                            "Payment Added Successfully!"
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
                    if (res.status == 'null_error') {
                        $("#paymentModal").modal('hide');
                        $("#paymentForm")[0].reset();
                        $(".errorMsgContainer").html("");
                        $(".table").load(location.href + ' .card');


                        Command: toastr["error"](
                            "Something Went Wrong! Paid Amount, Date and Bank field is required!"
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
                    if (res.status == 'error') {
                        $("#paymentModal").modal('hide');
                        $("#paymentForm")[0].reset();
                        $(".errorMsgContainer").html("");
                        $(".table").load(location.href + ' .card');


                        Command: toastr["error"](
                            "Paid Amount is not greater than due amount"
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

        // function refreshPage() {
        //     location.reload(true);
        // }
    });
</script>
