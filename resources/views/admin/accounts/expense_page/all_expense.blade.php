@php
    // $expenseAmount = App\Models\Expense::all();
    $total = $allExpense->sum('amount');
@endphp
@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Begin Page Content -->
    <div class="page-content">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row mb-4">
                    <div class="col-12 py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">All Expense</h6>
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('add.expense') }}">
                                <button class="btn btn-info">Add Expense</button>
                            </a>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <form method="POST" action="{{ route('get.expense')}}">
                        @csrf
                        <div class="errorMsgContainer"></div>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control ml-2 date_picker" name="start_date" id="start_date">
                                <input type="date" class="form-control ml-2 date_picker" name="end_date" id="end_date">
                                <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                            </div>
                    </form>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th class=" fs-4">Total: {{ $allExpense->sum('amount');}}/=</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allExpense as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->date }}</td>
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
                                        <a title="Expense Delete" id="delete" href="{{ route('delete.expense', $item->id) }}" style="margin-left: 5px;" class="btn btn-danger">
                                            <i class="fas fa-trash-alt    "></i>
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
