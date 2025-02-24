@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Customer</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('add.customer') }}">
                    <button class="btn btn-info">Add Customer</button>
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
                                    <th>Customer ID</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>telehone</th>
                                    <th>Address</th>
                                    <th>Due Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Customer ID</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>telehone</th>
                                    <th>Address</th>
                                    <th>Due Amount</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allData as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {{ $item->company_id }}
                                        </td>
                                        <td>
                                            {{ $item->email }}
                                        </td>
                                        <td>
                                            {{ $item->phone }}
                                        </td>
                                        <td>
                                            {{ $item->telephone }}
                                        </td>
                                        <td>
                                            {{ $item->address }}
                                        </td>
                                        
                                        <td>
                                           @php
                                                $companyamount = App\Models\AccountDetail::where('company_id', $item->id)->get();
                                                $due_amount =  $companyamount->sum('total_amount') - $companyamount->sum('paid_amount');
                                            @endphp
                                            {{ number_format($due_amount) }}
                                        </td>

                                        <td style="display:flex">
                                            <a style="margin-left: 5px;" href="{{ route('edit.company', $item->id) }}"
                                                class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if ($due_amount != 0)
                                                <a style="margin-left: 5px;"
                                                    href="{{ route('local.company.due.payment', $item->id) }}"
                                                    class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i> Due Payment
                                                </a>
                                            @else
                                            @endif

                                            <a style="margin-left: 5px;"
                                                href="{{ route('company.bill.local', $item->id) }}" class="btn btn-success text-white"
                                                title="Local Company Bill">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                View Bill
                                            </a>
                                            <a style="margin-left: 5px;"
                                                href="{{ route('company.bill.details', $item->id) }}" class="btn btn-secondary text-white"
                                                title="Local Company Bill">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                Payment Details
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
