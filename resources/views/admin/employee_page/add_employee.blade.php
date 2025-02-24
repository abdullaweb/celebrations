@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-muted">Add Employee</h2>
                            <form class="custom-validation" action="{{ route('store.employee') }}" method="POST"
                                novalidate="" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <input type="text" id="name" name="name" class="form-control" required=""
                                        placeholder="Employee Name"
                                        data-parsley-required-message="Employee Name is required">
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Employee Email">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input type="tel" id="phone" name="phone" class="form-control"
                                            required="" placeholder="Phone Number"
                                            data-parsley-required-message="Phone Number is required.">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            required="" placeholder="Enter Designation"
                                            data-parsley-required-message="Designation is required.">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input type="text" id="salary" name="salary" class="form-control"
                                            required="" placeholder="Enter Salary Amount" min="0"
                                            data-parsley-validation-threshold="0" data-parsley-trigger="keyup"
                                            data-parsley-type="digits"
                                            data-parsley-type-message="Input must be positive number">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <label for="" class="mb-2 mt-2"><b>Joining Date</b></label>
                                        <input type="date" id="joining_date" name="joining_date"
                                            class="form-control date_picker" placeholder="Joining Date">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div>
                                        <label for="" class="mb-2 mt-2"><b>NID Number</b></label>
                                        <input type="digit" id="nid" name="nid" class="form-control"
                                            placeholder="NID Number">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div>
                                        <label for="" class="mb-2 mt-2"><b>Address</b></label>
                                        <textarea name="address" id="address"
                                            class="form-control" rows="5" placeholder="Enter Your Address"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col text-secondary">
                                        <label for="" class="mb-2 mt-2"><b>Add Student Image</b></label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                    <div class="col-12 mt-3 text-secondary">
                                        <img id="showImage" src="{{ url('upload/no-image.jpg') }}" alt="Employee Image"
                                            width="200px" height="200px">
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Add Employee
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
