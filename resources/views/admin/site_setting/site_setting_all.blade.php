@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Site Setting</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('site.setting.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $siteSetting->id }}">
                            <div class="row mb-3">
                                <div class="col-12 text-secondary">
                                    <h6 class="mb-3">Site Title</h6>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $siteSetting->title }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 text-secondary">
                                    <h6 class="mb-3">CopyRight Text</h6>
                                    <input type="text" name="copyright" class="form-control"
                                        value="{{ $siteSetting->copyright }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 text-secondary">
                                    <h6 class="mb-3">Site Logo <span class="text-danger">Logo Size Must Be 137/60 </span> </h6>
                                    <input type="file" name="logo" class="form-control" id="logo"
                                        {{ $siteSetting->title }} />
                                </div>
                                <div class="col-sm-12 text-secondary mt-2">
                                    <img id="showLogo"
                                        src="{{ !empty($siteSetting->logo) ? url($siteSetting->logo) : url('upload/no-image.jpg') }}"
                                        alt="{{ $siteSetting->title }}" width="137px" height="30px">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 text-secondary">
                                    <h6 class="mb-3">Site Favicon</h6>
                                    <input type="file" name="favicon" class="form-control" id="favicon"
                                        {{ $siteSetting->title }} />
                                </div>
                                <div class="col-sm-12 text-secondary mt-2">
                                    <img id="showFavicon"
                                        src="{{ !empty($siteSetting->favicon) ? url($siteSetting->favicon) : url('upload/no-image.jpg') }}"
                                        alt="{{ $siteSetting->title }}" width="64px">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 text-secondary">
                                    <input type="submit" class="btn btn-info px-4" value="Save Changes" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showLogo').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
            $('#favicon').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showFavicon').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
    </script>
@endsection
