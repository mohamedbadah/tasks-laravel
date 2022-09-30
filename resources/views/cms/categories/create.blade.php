@extends('cms.parent')
@section('main_page','create')
@section('page_title',"create categories")
@section('small_page',"create categories")
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">categories create</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">name</label>
          <input type="text" class="form-control" name="name" id="name"> 
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="active" id="active">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="store()" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
@section('script')
  <script>
     function store(){
      let formData=new FormData();
      formData.append('name',document.getElementById('name').value);
      formData.append('active',document.getElementById('active').checked ? 1:0);
      formData.append('image',document.getElementById('image').files[0]);
      axios.post('/cms/admin/categories',formData)
                .then(function(response) {  
                    console.log(response);
                    toastr.success(response.data.message);
                    console.log(response.data.message)
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    toastr.error(error.response.data.message);
                    console.log(error.response.data.message)
                })
      
    }
  </script>
@endsection