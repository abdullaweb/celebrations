@extends('admin.admin_master')
@section('admin')
    <!-- Begin Page Content -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Advanced</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.advanced.salary') }}">
                    <button class="btn btn-info">Add Advanced</button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Employee ID</th>
                                <th>Salry</th>
                                <th>Advanced Amount</th>
                                <th>Date</th>
                                <th>Month</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Employee ID</th>
                                <th>Salary</th>
                                <th>Advanced Amount</th>
                                <th>Date</th>
                                <th>Month</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allAdvanced as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-capitalize">
                                        {{ $item['employee']['name'] ?? NULL }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item['employee']['employee_id'] ?? NULL}}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item['employee']['salary'] ?? NULL }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->advance_amount }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->date }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->month }}
                                    </td>
                                    <td>
                                        <a title="Update Advanced" href="{{ route('edit.advanced.salary', $item->id) }}"
                                            class="btn btn-info text-light">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a id="delete" href="{{ route('delete.advanced.salary', $item->id) }}"
                                            class="ml-2 btn btn-danger" id="delete" title="Advacned Salary Delete">
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

    <!-- End Page Content -->
@endsection
