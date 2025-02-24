@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daily Invoice Report</h6>
                    <h6 class="m-0 font-weight-bold text-primary">
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <form method="GET" action="{{ route('daily.invoice.pdf')}}" target="_blank" class="custom-validation"  novalidate="">
                            <div class="row">
                                <div class="col-md-4 form-group ">
                                    <input type="date" class="form-control ml-2 date_picker" name="start_date"
                                        id="start_date" required data-parsley-required-message="Please select start Date">

                                </div>
                                <div class="col-md-4 form-group ">
                                    <input type="date" class="form-control ml-2 date_picker" name="end_date"
                                        id="end_date" required data-parsley-required-message="Please select end Date">

                                </div>
                                <div class="col-md-4 form-group ">
                                    <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        {{-- <table class="table table-bordered" id="example" width="100%" cellspacing="0">
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
                        </table> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
@endsection
