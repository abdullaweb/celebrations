<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    $(document).ready(function() {

        // show edit value in update form
        $(document).on('click', '.bonusBtn', function() {
            let id = $(this).data('id');
            $('#up_id').val(id);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // add bonus js
        $(document).on('click', '.add-bonus', function(e) {
            e.preventDefault();
            let bonus_amount = $("#bonus_amount").val();
            let date = $("#date").val();
            let up_id = $("#up_id").val();
            console.log(bonus_amount, date, up_id);
            $.ajax({
                url: "{{ route('add.bonus') }}",
                method: 'post',
                data: {
                    up_id: up_id,
                    bonus_amount: bonus_amount,
                    date: date,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $("#AddBonusModal").modal('hide');
                        $("#AddBonusForm")[0].reset();
                        $(".errorMsgContainer").html("");
                        $(".table").load(location.href + ' .card');
                   

                        Command: toastr["success"](
                            "Bonus Added Successfully!"
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
