@extends('admin.layout.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12 offset-1">
                    <div class="cerficcate-section" style="background-image: url('backend/assets/images/certificate.png')">
                        <div class="main-layout">
                            <div class="compnay_logo mt-4">
                                <img width="20%" class="d-block m-auto" src="{{ asset('backend/assets/images/logo.png') }}"
                                    alt="">
                            </div>
                            <div class="fs-2 title text-center mt-3 mb-5">
                                <h2 class="fw-bold text-danger appreciation">Certification Of Appreciation</h2>
                                <h3 class="presented-to  text-uppercase">The Certification Proudly presented to </h3>
                            </div>
                            <div class="divider text-center">
                                <img width="60%" class="d-block m-auto" src="{{ asset('backend/assets/images/divider.png') }}"
                                    alt="">
                            </div>
                            <div class="student-name text-center">
                                <h2 class="name">Tanjil Hossain</h2>
                            </div>
                            <div class="divider text-center">
                                <img width="60%" class="d-block m-auto" src="{{ asset('backend/assets/images/divider.png') }}"
                                    alt="">
                            </div>
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="divider text-center mb-5"></div>
                                    <h3 class="course-name text-center mb-3">Professional Graphic Design Course</h3>
                                    <p class="course_bio text-center mb-3">Lorem ipsum dolor sit amet consectetur,
                                        adipisicing
                                        elit. Quaerat sit nulla iusto dolor sit amet consectetur, adipisicing elit. Quaerat
                                        sit nulla iusto ipsum dolor laboriosam necessitatibus.</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-10 offset-2">
                                    <div class="row d-flex align-items-end">
                                        <div class="col-3">
                                            <p class="fs-6 id-no">ID No: 14546458888</p>
                                        </div>
                                        <div class="col-4">
                                            <div class="signature-wrapper text-center">
                                                {{-- <img src="" alt=""> --}}
                                                <img width="100%" class="d-block m-auto"
                                                    src="{{ asset('backend/assets/images/signature.png') }}" alt="">
                                                <h6 class="fs-3 ceo-name">Md Arifur Rahman</h6>
                                                <p>Cheif Executive Officer (CEO)</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <p class="fs-6 course-date">Course Date: 12-12-2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
