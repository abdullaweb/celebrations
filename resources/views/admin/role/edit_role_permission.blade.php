@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-muted">Add Role Permission</h4>
                            <form class="custom-validation" action="{{ route('admin.role.update',$role->id) }}" method="POST"
                                novalidate="" id="form" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <label for="">Roles Name</label>
                                        <div class="mb-2">
                                            <input type="text" class="form-control" readonly value="{{ $role->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="checkAllPermission">
                                            <label class="form-check-label" for="checkAllPermission">
                                                All Permission
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-3">
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            @php
                                                $permissions = App\Models\User::getPermissionNameByGroupName($group->group_name);
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="group_name"
                                                    {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="group_name">
                                                    {{ $group->group_name }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-3">

                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input" name="permission[]" type="checkbox"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}}
                                                        value="{{ $permission->id }}" id="group_list{{ $permission->id }}">
                                                    <label class="form-check-label" for="group_list{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <div class="mb-0 mt-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Add Role Permission
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
    <script>
        $('#checkAllPermission').click(function() {
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').prop('checked', true);
            } else {
                $('input[type="checkbox"]').prop('checked', false);
            }
        });
    </script>
@endsection
