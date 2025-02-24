@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" class="custom-validation" action="{{ route('store.expense') }}" novalidate="">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Expense Purpose</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select name="expense_head" id="expense_head" class="form-control select2" required
                                        data-parsley-required-message="Expense Purpose is required." aria-readonly="true">
                                        <option value="">Select Expense Purpose</option>
                                        <option value="House Rent">House Rent</option>
                                        <option value="Salary">Salary</option>
                                        <option value="Utility">Utility Bill</option>
                                        <option value="Snacks">Snacks</option>
                                        <option value="Other">Others</option>
                                    </select>
                                    <input style="display: none;" type="text" name="others"
                                        placeholder="Enter Your Purpose" class="form-control others">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Expense Description</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="description" id="description" class="form-control"
                                        placeholder="Description">
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
                                        placeholder="Enter Amount" required
                                        data-parsley-error-message="Amount is required" />
                                </div>
                                <div class="col-sm-3 mt-3">
                                    <h6>Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary mt-3">
                                    <input type="date" name="date" class="form-control date_picker" id="date" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 col-lg-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Add Expense" />
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
    <script>
        $(document).ready(function() {




            $(document).on('change', '#expense_head', function() {
                let description = $(this).val();
                if (description == 'Other') {
                    $('.others').show();
                    $('.date').hide();
                } else if (description == 'Salary') {
                    $('.date').show();
                    $('.others').hide();
                } else {
                    $('.others').hide();
                    $('.date').hide();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#date').on('change', function() {
                let date = $(this).val();
                $.ajax({
                    url: '{{ route('get.salary') }}?date=' + date,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $("#amount").val(data);
                    }
                });
            });
        });
    </script>
@endsection
