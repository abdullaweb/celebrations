@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-muted">Update Role</h4>
                            <form class="custom-validation" action="{{ route('update.role') }}" method="POST" novalidate=""
                                id="form" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <input type="hidden" name="id" value="{{ $roleInfo->id }}">
                                        <div class="mb-2">
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Role Name" required=""
                                                data-parsley-required-message="Role Name is required"
                                                value="{{ $roleInfo->name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0 mt-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Update Role
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
