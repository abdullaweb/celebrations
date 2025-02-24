@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Begin Page Content -->
    <div class="app-main__inner">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Overtime</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.overtime') }}">
                    <button class="btn btn-info">Add Overtime</button>
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
                                <th>Ot Hour</th>
                                <th>Ot Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Employee Name</th>
                                <th>Ot Hour</th>
                                <th>Ot Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allOvertime as $key => $overtime)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-capitalize">
                                        {{ $overtime['employee']['name'] }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $overtime->ot_hour }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ number_format($overtime->ot_amount) }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $overtime->month }}, {{ $overtime->year }}
                                    </td>

                                    <td style="display:flex;">
                                        <a title="Update Overtime" href="{{ route('edit.overtime', $item->id) }}"
                                            class="btn btn-dark text-light">
                                            <i class="fas fa-edit    "></i>
                                        </a>
                                        <a id="delete" href="{{ route('delete.overtime', $item->id) }}"
                                            class="ml-5 btn btn-danger" title="Overtime Delete">
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
