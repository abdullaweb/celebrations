@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <div class="app-main__inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body py-5">
                        <form action="{{ route('update.bonus') }}" method="POST" class="custom-validation" novalidate=""
                            autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{ $bonusInfo->id }}">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Employee Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control" name="employee_id" id="employee_id">
                                        <option selected disabled>Select Employee Name</option>
                                        @foreach ($employees as $employee)
                                            <option class="text-capitalize" value="{{ $employee->id }}"
                                                {{ $employee->id == $bonusInfo->employee_id ? 'selected' : '' }}>
                                                {{ $employee->name }} - {{ $employee->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Bonus Amount</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="mb-2">
                                        <input type="text" id="bonus_amount" name="bonus_amount" class="form-control"
                                            required="" data-parsley-trigger="keyup"
                                            data-parsley-validation-threshold="0" placeholder="Bonus Amount"
                                            data-parsley-type="number"
                                            data-parsley-type-message="Input must be positive number"
                                            data-parsley-required-message="Bonus is required"
                                            value="{{ $bonusInfo->bonus_amount }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" autocomplete="off"
                                        value="{{ date('Y-m-d', strtotime($bonusInfo->created_at)) }}" id="date"
                                        name="date" class="form-control date_picker" required
                                        data-parsley-required-message="Date is required" placeholder="Enter Your Date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 col-lg-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Update Bonus" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- js --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    {{--  add more purchase   --}}
    <script>
        $(document).ready(function() {

            $(document).on("keyup", ".product_price,.product_qty", function() {
                let product_qty = $('input.product_qty').val();
                let product_price = $('input.product_price').val();
                let total = product_price * product_qty;
                $('input.total_amount').val(total);
            });
        });
    </script>
@endsection
