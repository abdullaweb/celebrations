@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-muted">{{ $title }}</h2>
                            <form method="POST" class="custom-validation" action="{{ route('store.tax') }}" novalidate="" autocomplete="off">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <input type="text" id="name" name="name" class="form-control" required=""
                                        placeholder="Tax Name" data-parsley-required-message="Tax name is required">
                                </div>


                                <div class="mb-3">
                                    <div>
                                        <input type="digit" id="rate" name="rate" class="form-control"
                                            required="" placeholder="Enter tax rate in percentage"
                                            data-parsley-required-message="Tax rate is required.">
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <button type="submit" class="btn btn-info waves-effect waves-light me-1">
                                        Add Tax
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
