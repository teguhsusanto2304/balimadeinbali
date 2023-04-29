@extends('adminlte::page')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }} ">
@section('title', 'Supplier')
   
@section('content_header')
    <h1>Proofing</h1>
@stop
@section('content')
<!-- general form elements -->
<div class="card ">
    <div class="card-header">
      <h3 class="card-title"><strong>Proofing Form</strong></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if(empty($data['id']))
    <form action="{{ route('proofings.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    @else
    <form action="{{ route('suppliers.update',$data['id']) }}" method="POST">
        @csrf
        @method('PUT')
    @endif
      <div class="card-body">
        <div class="form-group col-8">
          {!! Form::label("supplier_id", "Supplier", null) !!}
          {!! Form::select('supplier_id',$suppliers,(!empty($data['supplier_id']) ?$data['supplier_id']:''),['id'=>'supplier_id','class'=>'form-control '.($errors->has('supplier_id') ? 'is-invalid' : '')]) !!}
          @if($errors->has('supplier_id'))
          <small class="text-danger">{{ $errors->first('supplier_id') }}</small>
          @endif
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    {!! Form::label("purpose_at", "Purpose At", null) !!}
                    {!! Form::date('purpose_at', (empty($data['purpose_at']) ?'':date('Y-m-d',strtotime($data['purpose_at'])) ), ['id'=>'purpose_at','class'=>'form-control '.($errors->has('purpose_at') ? 'is-invalid' : '')]) !!}
                    @if($errors->has('purpose_at'))
                    <small class="text-danger">{{ $errors->first('purpose_at') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                  {!! Form::label("proofing_at", "Proofing At", null) !!}
                  {!! Form::date('proofing_at', (empty($data['proofing_at']) ?'':date('Y-m-d',strtotime($data['proofing_at'])) ), ['id'=>'proofing_at','class'=>'form-control '.($errors->has('proofing_at') ? 'is-invalid' : '')]) !!}
                  @if($errors->has('proofing_at'))
                  <small class="text-danger">{{ $errors->first('proofing_at') }}</small>
                  @endif
              </div>
          </div>            
        </div>
        <div class="form-group col-7">
          {!! Form::label("proof_image", "Proofing File", null) !!}
          {!! Form::file("proof_image", ['id'=>'path_image','class'=>'form-control '.($errors->has('proof_image') ? 'is-invalid' : '')]) !!}
          @if($errors->has('proof_image'))
          <small class="text-danger">{{ $errors->first('proof_image') }}</small>
          @endif
        </div>
        <div class="form-group">
          {!! Form::label("description", "Description", null) !!}
          {!! Form::textarea("description", (!empty($data['description']) ?$data['description']:''), ['id'=>'description','rows' => 4, 'cols' => 54,'class'=>'form-control '.($errors->has('description') ? 'is-invalid' : '')]) !!}
          @if($errors->has('description'))
          <small class="text-danger">{{ $errors->first('description') }}</small>
          @endif
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="checkActive" name="data_status" {{ (empty($data['data_status']) ? 'checked': ($data['data_status']==1 ? 'checked':'')) }}>
          <label class="form-check-label" for="checkActive">Active</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="{{ route('proofings.index')}}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@stop