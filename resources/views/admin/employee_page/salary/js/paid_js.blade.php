<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('backend/assets/js/code.js') }}"></script>


<script>
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
</script>

<script>
    $(document).ready(function() {

        $(document).on('click', '.paidBtn', function() {
            let id = $(this).data('id');
            let status = $(this).data('status');
            if (status == 0) {
                status = 1;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('change.status.batch') }}",
                method: 'post',
                data: {
                    up_id: id,
                    up_status: status,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $(".table").load(location.href + ' .table');
                        Command: toastr["success"]("Batch Status Change!")

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
                            "timeOut": "2000",
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
