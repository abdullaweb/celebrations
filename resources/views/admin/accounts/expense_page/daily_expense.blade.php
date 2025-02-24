@extends('admin.layout.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daily Expense</h6>
                <h6 class="m-0 font-weight-bold text-primary">
                    <a href="{{ route('add.expense') }}">
                        <button class="btn btn-info">Add Expense</button>
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6 offset-md-4">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-info">
                                <a href="{{ route('daily.expense') }}">Daily Expense</a>
                            </button>
                            <button type="button" class="btn btn-outline-info">
                                <a href="{{ route('monthly.expense') }}">Monthly Expense</a>
                            </button>
                            <button type="button" class="btn btn-outline-info">
                                <a href="{{ route('yearly.expense') }}">Yearly Expense</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Description</th>
                                <th class=" fs-4">Total: {{ $totalDailyExpense }}/=</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($todayExpense as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-capitalize">
                                        {{ $item->description }}
                                    </td>
                                    <td>
                                        {{ $item->amount }}
                                    </td>
                                    <td style="display:flex">
                                        <a href="{{ route('edit.expense', $item->id) }}" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
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

    @include('admin.batch_page.js_batch')
@endsection
