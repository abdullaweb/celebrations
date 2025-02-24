@extends('admin.admin_master')
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Begin Page Content -->
    <div class="page-content">
        <div class="card-header pb-3  d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Profit Data</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ url()->previous() }}">
                    <button class="btn btn-info">Back</button>
                </a>
            </h6>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive" id="printContent">
                    <h4 class="text-muted text-center underline">Profit from
                        {{ date('d-m-Y', strtotime(Request::post('start_date'))) }} to
                        {{ date('d-m-Y', strtotime(Request::post('end_date'))) }}</h4>
                    <hr>
                    <h5 class="text-center text-muted mb-3">Total Profit: <strong>BDT {{ $profit }}</strong> </h5>
                </div>
            </div>

        </div>

    </div>
    <!-- End Page Content -->
@endsection
