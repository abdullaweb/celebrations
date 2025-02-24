@extends('admin.admin_master')
@section('admin')
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-muted">Monthly Salary</h2>
                        <form class="custom-validation" action="{{ route('get.monthly.salary') }}" method="POST"
                            novalidate="">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="mb-3">
                                        <input type="date" id="date" name="date" class="form-control date_picker"
                                            required data-parsley-required-message="date is required"
                                            placeholder="Effected Date">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="mb-3">
                                        <button id="search" type="submit"
                                            class="btn btn-primary waves-effect waves-light me-1">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div id="documentResults">
                        <script id="document-template" type="text/x-handlebars-template">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        @{{{ thsource}}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @{{#each this}}
                                        <tr>
                                           @{{{tdsource}}}
                                        </tr>
                                    @{{/each}}
                                </tbody>
                            </table>
                        </script>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // image on load
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $(document).on('click', '#search', function() {
                let date = $("#date").val();
                console.log('month', month);

                $.ajax({
                    url: "{{ route('get.monthly.salary') }}",
                    method: 'get',
                    data: {
                        date: date,
                    },
                    beforeSend: function(){

                    },
                    success: function(data){
                        let source = $('#document-template').html();
                        let template = Handlebars.compile(source);
                        let html = template(data);
                        $('#documentResults').html(html);
                        $('[data-toggle="tooltip"]').tooltip();

                    }
                });
            });
        });
    </script> --}}
@endsection
