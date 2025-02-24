@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.tax') }}">
                    <button class="btn btn-info"> <i class="fa fa-plus-circle" aria-hidden="true"> Add {{ $title }}</i>
                    </button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Rate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Rate</th>
                                        <th>Action</th>
                                    </tr>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($allTax as $key => $tax)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $tax->name }}
                                            </td>
                                            <td>
                                                {{ $tax->rate }}%
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a style="margin-left: 5px;" href="{{ route('edit.tax', $tax->id) }}"
                                                        class="btn btn-info text-white" title="Edit Tax">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a style="margin-left: 5px;" href="{{ route('delete.tax', $tax->id) }}"
                                                        class="btn btn-danger text-white" id="delete" title="Delete Tax">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    @if ($tax->status == '0')
                                                        <a style="margin-left: 5px;"
                                                            href="{{ route('active.tax', $tax->id) }}"
                                                            class="btn btn-dark text-white" id="active"
                                                            title="Active Tax">
                                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                        </a>
                                                    @else
                                                        <a style="margin-left: 5px;"
                                                            href="{{ route('deactive.tax', $tax->id) }}"
                                                            class="btn btn-dark text-white" id="deactive"
                                                            title="Deactive Tax">
                                                            <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                </div>
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

    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
@endsection
