@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Begin Page Content -->
    <div class="app-main__inner">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Bonus</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.bonus') }}">
                    <button class="btn btn-info">Add Bonus</button>
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
                                <th>Employee Name</th>
                                <th>Bonus Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Employee Name</th>
                                <th>Bonus Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allBonus as $key => $bonus)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-capitalize">
                                        {{ $bonus['employee']['name'] }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $bonus->bonus_amount }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $bonus->month }}, {{ $bonus->year }}
                                    </td>
                                    <td style="display:flex">
                                        <a title="Update Advanced" href="{{ route('edit.bonus', $bonus->id) }}"
                                            class="btn btn-dark text-light">
                                            <i class="fas fa-edit    "></i>
                                        </a>
                                        <a id="delete" href="{{ route('delete.bonus', $bonus->id) }}"
                                            class="ml-2 btn btn-danger" id="delete" title="Overtime Delete">
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
