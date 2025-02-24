@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-muted">Update Employee</h2>
                            <form method="POST" class="custom-validation" action="{{ route('update.employee') }}" novalidate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$employeeInfo->id}}">
                                <div class="mb-3 mt-3">
                                    <label>Employee ID</label>
                                    <input type="text" id="employee_id" name="employee_id" class="form-control"
                                        required="" placeholder="Employee Id"
                                        data-parsley-required-message="Employee ID is required" value="{{$employeeInfo->employee_id}}" readonly>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label>Employee Name</label>
                                    <input type="text" id="name" name="name" class="form-control" required=""
                                        placeholder="Employee Name"
                                        data-parsley-required-message="Company Name is required" value="{{$employeeInfo->name}}">
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <label>Employee Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            required="" parsley-type="email" placeholder="Employee Email"
                                            data-parsley-required-message="Email is required." value="{{$employeeInfo->email}}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <label>Employee Phone</label>
                                        <input type="tel" id="phone" name="phone" class="form-control"
                                            required="" placeholder="Phone Number"
                                            data-parsley-required-message="Phone Number is required." value="{{$employeeInfo->phone}}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <label>Employee Designation</label>
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            required="" placeholder="Enter Designation"
                                            data-parsley-required-message="Designation is required." value="{{$employeeInfo->designation}}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <label>Employee Salary</label>
                                        <input type="text" id="salary" name="salary" class="form-control"
                                            required="" placeholder="Enter Salary Amount" min="0"
                                            data-parsley-validation-threshold="0" data-parsley-trigger="keyup"
                                            data-parsley-type="digits"
                                            data-parsley-type-message="Input must be positive number" value="{{$employeeInfo->salary}}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input readonly type="text" id="joining_date" name="joining_date" class="form-control"
                                            placeholder="Joining Date" value="{{$employeeInfo->joining_date}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col text-secondary">
                                        <label for="" class="mb-2 mt-2"><b>Add Student Image</b></label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                    <div class="col-12 mt-3 text-secondary">
                                        <img id="showImage" src="{{ !empty($employeeInfo->image) ? url($employeeInfo->image) : url('upload/no-image.jpg') }}" alt="Employee Image"
                                            width="200px" height="200px">
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Update Employee
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
