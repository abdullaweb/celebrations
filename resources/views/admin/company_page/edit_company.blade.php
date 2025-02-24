@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-muted">Update Customer</h2>
                            <form  method="POST" class="custom-validation" action="{{ route('update.company') }}" novalidate="">
                                @csrf
                                <input type="hidden" value="{{ $companyInfo->id }}" name="id">
                                <div class="mb-3 mt-3">
                                    <input type="text" id="name" name="name" class="form-control" required=""
                                        placeholder="Company Name" value="{{ $companyInfo->name }}" data-parsley-required-message="Company Name is required">
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input type="email" class="form-control" name="email" id="email"
                                            required="" parsley-type="email" placeholder="Enter a valid email"
                                            data-parsley-required-message="Email is required." value="{{ $companyInfo->email }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input type="tel" id="phone" name="phone" class="form-control"
                                            required="" placeholder="Phone Number"
                                            data-parsley-required-message="Phone Number is required." value="{{ $companyInfo->phone }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input type="tel" id="telephone" name="telephone" class="form-control"
                                            placeholder="Telephone Number" value="{{ $companyInfo->telephone }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <input type="text" id="bin_number" name="bin_number" class="form-control"
                                            placeholder="Bin Number" value="{{ $companyInfo->bin_number }}">
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <div>
                                        <textarea required="" data-parsley-required-message="Address is required." name="address" id="address"
                                            class="form-control" rows="5" placeholder="Enter Your Copmpnay Address">{{ $companyInfo->address }}</textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <textarea name="cor_address" id="cor_address"
                                            class="form-control" rows="5" placeholder="Enter Your Corporate Address">{{ $companyInfo->cor_address }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-info waves-effect waves-light me-1">
                                            Update Customer
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                        <a id="delete" title="Delete Customer" style="margin-left: 5px;"
                                            href="{{ route('delete.company', $companyInfo->id) }}" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete Customer
                                        </a>
                                        <a id="delete" style="margin-left: 5px;"
                                            href="{{ route('company.bill.delete', $companyInfo->id) }}"
                                            class="btn btn-danger" title="Company Bill">
                                            <i class="fas fa-trash-alt    "></i>
                                            Delete All Bill
                                        </a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
