<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    $(document).ready(function() {

        // show edit value in update form
        $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');
            $('#up_id').val(id);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // add hour js
        $(document).on('click', '.add-over-time', function(e) {
            e.preventDefault();

            let ot_hour = $("#ot_hour").val();
            let effected_date = $("#effected_date").val();
            let up_id = $("#up_id").val();
            console.log(ot_hour, up_id);

            $.ajax({
                url: "{{ route('add.ot.hour') }}",
                method: 'post',
                data: {
                    up_id: up_id,
                    ot_hour: ot_hour,
                    effected_date: effected_date,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $("#AddHourModal").modal('hide');
                        $("#AddHourForm")[0].reset();
                        $(".errorMsgContainer").html("");
                        $(".table").load(location.href + ' .table');

                        Command: toastr["success"](
                            "Over Time Added!"
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

    });
</script>
