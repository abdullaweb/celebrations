@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <form method="POST" action="{{ route('get.expense') }}">
                @csrf
                <div class="errorMsgContainer"></div>
                <div class="input-group mb-3">
                    <input type="date" class="form-control ml-2 date_picker" name="start_date" id="start_date">
                    <input type="date" class="form-control ml-2 date_picker" name="end_date" id="end_date">
                    <button class="btn btn-primary submit_btn ml-2" type="submit">Search</button>
                </div>
            </form>
        </div>
    @endsection
