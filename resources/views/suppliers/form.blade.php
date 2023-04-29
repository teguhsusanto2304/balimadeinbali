@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
@section('title', 'Supplier')
   
@section('content_header')
    <h1>Suppliers</h1>
@stop
@section('content')
<!-- general form elements -->
<div class="card ">
    <div class="card-header">
      <h3 class="card-title"><strong>Supplier Form</strong></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if(empty($data['id']))
    <form action="{{ route('suppliers.store') }}" method="post">
        @csrf
    @else
    <form action="{{ route('suppliers.update',$data['id']) }}" method="POST">
        @csrf
        @method('PUT')
    @endif
      <div class="card-body">
        <div class="form-group">
          <label for="inputName">Supplier Name</label>
          <input type="text" class="form-control {{ $errors->has('supplier_name') ? 'is-invalid' : '' }}" id="inputName" value="{{ (empty($data['supplier_name']) ? old('supplier_name'):$data['supplier_name']) }}" name="supplier_name" placeholder="Enter supplier name">
          @if($errors->has('supplier_name'))
          <small class="text-danger">{{ $errors->first('supplier_name') }}</small>
          @endif
        </div>
        <div class="row">
            <div class="col-9">
                <div class="form-group">
                    <label for="inputContact">Contact Person</label>
                    <input type="text" class="form-control  {{ $errors->has('kontaks') ? 'is-invalid' : '' }}" id="inputContact" value="{{ (empty($data['kontaks']) ? old('kontaks'):$data['kontaks']) }}" name="kontaks" placeholder="Enter Contact Person">
                    @if($errors->has('kontaks'))
                    <small class="text-danger">{{ $errors->first('kontaks') }}</small>
                    @endif
                </div>
                </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="inputPhoneNumber">Phone Number</label>            
                    <input type="number" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" id="inputPhoneNumber" value="{{ (empty($data['phone_number']) ? old('phone_number'):$data['phone_number']) }}" name="phone_number" placeholder="Enter Phone Number">
                    @if($errors->has('phone_number'))
                    <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter Email" value="{{ (empty($data['email']) ? old('email'):$data['email']) }}">
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="checkActive" name="data_status" {{ (empty($data['data_status']) ? 'checked': ($data['data_status']==1 ? 'checked':'')) }}>
          <label class="form-check-label" for="checkActive">Active</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('suppliers.index')}}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@stop