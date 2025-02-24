@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="app-main__inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-muted">Add Bonus</h4>
                            <form class="custom-validation" action="{{ route('store.bonus') }}" method="POST" novalidate=""
                                id="form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <div class="mb-2">
                                            <select name="employee_id" id="employee_id" class="form-control" required
                                                data-parsley-required-message="Employee Id is required" autocomplete="off">
                                                <option disabled selected>Select Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->name }} -
                                                        {{ $employee->phone }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="mb-2">
                                            <input type="text" id="bonus_amount" name="bonus_amount" class="form-control"
                                                required="" data-parsley-trigger="keyup"
                                                data-parsley-validation-threshold="0" placeholder="Bonus Amount"
                                                data-parsley-type="number"
                                                data-parsley-type-message="Input must be positive number"
                                                data-parsley-required-message="Bonus is required" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="mb-3">
                                            <input type="text" autocomplete="off" id="date" name="date"
                                                class="form-control date_picker" required
                                                data-parsley-required-message="Bonus Date is required"
                                                placeholder="Bonus Month & Year">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Add Bonus
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#form').parsley();
    </script>
@endsection
