@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-muted">Increment Salary</h2>
                        <form class="custom-validation" action="{{ route('update.employee.salary', $allData->id) }}" method="POST" novalidate="">
                            @csrf
                            <div class="row">
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <input type="digit" id="increment_salary" name="increment_salary"
                                            class="form-control" required="" data-parsley-trigger="keyup"
                                            data-parsley-validation-threshold="0" placeholder="Incremnt Salary"
                                            data-parsley-type="number"
                                            data-parsley-type-message="Input must be positive number"  data-parsley-required-message="Increment Salary is required">
                                    </div>
                                </div>
                                <div class="col-md mt-3">
                                    <div class="mb-3">
                                        <input type="date" id="effected_salary" name="effected_salary"
                                            class="form-control date_picker" required
                                            data-parsley-required-message="Effected date is required"
                                            placeholder="Effected Date">
                                    </div>
                                </div>

                            </div>

                            <div class="mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Increment Salary
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
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
@endsection
