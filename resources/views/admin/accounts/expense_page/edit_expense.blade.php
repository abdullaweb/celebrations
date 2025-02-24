@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Update Expense</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Expense</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('update.expense') }}" method="POST" id="AddExpense">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Expense Purpose</h6>
                                        </div>
                                        <input type="hidden" name="id" value="{{$expenseInfo->id}}">
                                        <div class="col-sm-9 text-secondary">
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @if ($expenseInfo->description == 'Salary' || $expenseInfo->description == 'House Rent')
                                                <select name="description" id="description" class="form-control" required
                                                    data-parsley-required-message="Expense Purpose is required."
                                                    aria-readonly="true">

                                                    @if ($expenseInfo->description == 'Salary' || $expenseInfo->description == 'House Rent')
                                                        <option value="House Rent"
                                                            {{ $expenseInfo->description == 'House Rent' ? 'selected' : '' }}>
                                                            House Rent</option>
                                                        <option value="Salary"
                                                            {{ $expenseInfo->description == 'Salary' ? 'selected' : '' }}>
                                                            Salary</option>
                                                    @else
                                                        <input type="text" name="others"
                                                            value="{{ $expenseInfo->description }}" class="form-control">
                                                    @endif
                                                </select>
                                            @else
                                                <input type="text" name="others" value="{{ $expenseInfo->description }}"
                                                    class="form-control">
                                            @endif

                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Amount</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <input type="text" name="amount" class="form-control" id="amount"
                                                value="{{ $expenseInfo->amount }}" required
                                                data-parsley-error-message="Amount is required" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 col-lg-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Update Expense" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- js --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#AddExpense').parsley();


            $(document).on('change', '#description', function() {
                let description = $(this).val();
                console.log(description);
                if (description == 'Other') {
                    $('.others').show();
                } else {
                    $('.others').hide();
                }
            });
        });
    </script>
@endsection
