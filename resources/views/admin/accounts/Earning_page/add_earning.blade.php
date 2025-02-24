@extends('admin.layout.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Earning</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Earning</li>
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
                                <form action="{{ route('store.earning') }}" method="POST" id="AddEarning">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Earning Purpose</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            @error('earn_head')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <input type="text" name="earn_head" placeholder="Type Your Earning Purpose" class="form-control" id="earn_head" required
                                            data-parsley-required-message="Earning Purpose is required.">
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <input type="date" name="date" class="form-control" id="date" required
                                            data-parsley-required-message="Date is required."/>
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
                                            <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter your amount" min="0"
                                            data-parsley-validation-threshold="0" data-parsley-trigger="keyup"
                                            data-parsley-type="digits" data-parsley-type-message="Input must be positive number" required data-parsley-required-message="Amount is required."/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Earning Source</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            @error('earn_source')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <select name="earn_source" id="earn_source" class="form-control" required
                                            data-parsley-required-message="Earing Source is required.">
                                                <option value="" selected disabled>Select Earning Source</option>
                                                <option value="Software">Software</option>
                                                <option value="Digital Marketing">Digital Marketing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 col-lg-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Add Earning" />
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
            $('#AddEarning').parsley();
        });
    </script>
@endsection
