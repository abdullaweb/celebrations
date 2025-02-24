@extends('admin.layout.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Income By Batch Wise</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href=""><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> <span class="text-primary">
                                <a href="">Go Back</a>
                            </span>
                        </li>
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
                            <div class="card-body" id="printContent">
                                <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Batch ID</th>
                                            <th>Income</th>
                                            <th>Total Due</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Batch ID</th>
                                            <th>Income</th>
                                            <th>Total Due</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($batchId as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="text-capitalize">
                                                    {{ $item->batch_id }}
                                                </td>
                                                <td>
                                                    @php

                                                     $payments = App\Models\Student::join('payments', 'payments.s_id', '=', 'students.id')
                                                     ->where('widthdrawn', '0')
                                                     ->where('batch_id', $item->batch_id);
                                                    $totalIncome = $payments->sum('paid_amount');
                                                    @endphp
                                                    {{ $totalIncome}}
                                                </td>
                                                <td>
                                                    @php

                                                     $payments = App\Models\Student::join('payments', 'payments.s_id', '=', 'students.id')
                                                     ->where('widthdrawn', '0')
                                                     ->where('batch_id', $item->batch_id);
                                                    $totalDue = $payments->sum('due_amount');
                                                    @endphp
                                                    {{ $totalDue}}
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
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#StudentForm').parsley();

            // image on load
            $('#student_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showStudentImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
    </script>
    <script>
        tinymce.init({
            selector: 'textarea#tiny'
        });
    </script>

@endsection
