@php
    $purchaseAmount = App\Models\Purchase::all();
    $total = $purchaseAmount->sum('total_amount');
@endphp
@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Begin Page Content -->
    <div class="page-content">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-12 py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">All Advanced</h6>
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('add.advanced.salary') }}">
                                <button class="btn btn-info">Add Advanced</button>
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Employee ID</th>
                                <th>Advanced Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Employee ID</th>
                                <th>Advanced Amount</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allAdvanced as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-capitalize">
                                        {{ $item['employee']['name'] }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item['employee']['employee_id'] }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $item->advanced_amount }}
                                    </td>
                                    <td style="display:flex">
                                        <a title="Update Advanced" href="{{ route('edit.advanced.salary', $item->id) }}"
                                            class="btn btn-dark text-light">
                                            <i class="fa fa-plus-square" aria-hidden="true"></i> Update Advanced
                                        </a>
                                        <a href="{{ route('delete.advanced.salary', $item->id) }}" class="btn btn-danger"
                                            id="delete" title="Advacned Salary Delete">
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
