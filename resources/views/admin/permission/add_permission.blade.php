@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-muted">Add permission</h4>
                            <form class="custom-validation" action="{{ route('store.permission') }}" method="POST"
                                novalidate="" id="form" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <div class="mb-2">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Permission Name"
                                                required="" data-parsley-required-message="Permission Name is required">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="mb-2">
                                            <select name="group_name" id="group_name" class="form-control select2" required
                                                data-parsley-required-message="Group Name is required">
                                                <option disabled selected>Select Group Name</option>
                                                <option value="customer">Customer</option>
                                                <option value="product">Product</option>
                                                <option value="sale">Sale</option>
                                                <option value="invoice">Invoice</option>
                                                <option value="purchase">Purchase</option>
                                                <option value="account">Account</option>
                                                <option value="report">Report</option>
                                                <option value="employee">Employee</option>
                                                <option value="salary">Salary</option>
                                                <option value="role">Role</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0 mt-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Add Permission
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#form').parsley();
    </script>
@endsection
