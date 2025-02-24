@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Admin</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.admin') }}">
                    <button class="btn btn-info">Add Admin</button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allAdmin as $key => $admin)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $admin->name }}
                                        </td>
                                        <td>
                                            {{ $admin->email }}
                                        </td>
                                        <td>
                                            {{ $admin->phone }}
                                        </td>
                                        <td>
                                            @foreach ($admin->roles as $role)
                                                <span class="badge badge-pill bg-danger text-light">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <img src="{{ !empty($admin->photo) ? url('upload/admin_images/' . $admin->photo) : url('upload/no-image.jpg') }}"
                                                class="rounded-circle" width="46" height="46" alt="" />
                                        </td>
                                        <td style="display:flex">
                                            <a title="Edit Admin" style="margin-left: 5px;"
                                                href="{{ route('edit.admin.role', $admin->id) }}" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a title="Delete Admin" id="delete" style="margin-left: 5px;"
                                                href="{{ route('delete.admin.role', $admin->id) }}" class="btn btn-danger"
                                                title="Delete Employee">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
@endsection
