<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    $(document).ready(function() {

        // show edit value in update form
        $(document).on('click', '.paymentBtn', function() {
            let id = $(this).data('id');
            $('#up_id').val(id);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

     
        // add hour js
        $(document).on('click', '.add-payment', function(e) {
            e.preventDefault();
            let pay_amount = $("#pay_amount").val();
            let payment_date = $("#payment_date").val();
            let voucher = $("#voucher").val();
            let up_id = $("#up_id").val();
            let payment_type = $("input:radio[name=payment_type]:checked").val();


            $.ajax({
                url: "{{ route('add.payment') }}",
                method: 'post',
                data: {
                    up_id: up_id,
                    voucher: voucher,
                    pay_amount: pay_amount,
                    payment_type: payment_type,
                    date: payment_date,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $("#AddPaymentModal").modal('hide');
                        $("#AddPaymentForm")[0].reset();
                        $(".errorMsgContainer").html("");
                        $(".table").load(location.href + ' .card');
                        // $(".table").load(location.href + ' .table');
                        // location.reload();
                        // setInterval('refreshPage()', 5000);

                        Command: toastr["success"](
                            "Payment Added!"
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
                        $("#AddPaymentModal").modal('hide');
                        $("#AddPaymentForm")[0].reset();
                        $(".errorMsgContainer").html("");
                        $(".table").load(location.href + ' .card');



                        Command: toastr["error"](
                            "Payment Failed! Payment not be grater than advanced."
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
                    let error = err.responseJSON;
                    console.log(error);
                    $.each(error.errors, function(index, value) {
                        $(".errorMsgContainer").append(
                            '<span class="text-danger">' + value + '</span>' +
                            '<br>');
                    });
                }
            });
        });

        function refreshPage() {
            location.reload(true);
        }
    });
</script>
