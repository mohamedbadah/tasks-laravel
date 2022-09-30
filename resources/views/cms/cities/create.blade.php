@extends('cms.parent')
@section('main_page','create')
@section('page_title',"create cities")
@section('small_page',"create cities")
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">cities create</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('cities.store')}}" method="POST">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">name</label>
          <input type="text" class="form-control" name="name">
          @error('name')
         <div class="alert alert-danger">{{ $message }}</div>
           @enderror
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="active">
          @error('active')
         <div class="alert alert-danger">{{ $message }}</div>
           @enderror
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection