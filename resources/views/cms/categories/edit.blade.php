@extends('cms.parent')
@section('main_page','udate')
@section('page_title',"update categories")
@section('small_page',"update categories")
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">cities create</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">name</label>
          <input type="text" class="form-control" id="name" value="@if(old('name')) {{old('name')}} @else {{$category->name}} @endif">
          @error('name')
         <div class="alert alert-danger">{{ $message }}</div>
           @enderror
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="active" @if ($category->active) @checked(true) @endif>
          @error('active')
         <div class="alert alert-danger">{{ $message }}</div>
           @enderror
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="update({{$category->id}})" class="btn btn-primary">update</button>
      </div>
    </form>
  </div>
@endsection
@section('script')
  <script>
    function update(id){
      // axios.put(`/cms/admin/categories/${id}`,{
      //   name:document.getElementById('name').value,
      //   active:document.getElementById('active').checked
      // })
      //   .then(function(response){
      //     console.log(response.data.message);
      //     toastr.success(response.data.message);
      // }).catch(function(error){
      //   console.log(error.response.data.message);
      //   toastr.error(error.response.data.message);
      // })
      let formData=new FormData();
      formData.append('name',document.getElementById('name').value);
      formData.append('active',document.getElementById('active').checked ? 1:0);
      axios.put(`/cms/admin/categories/${id}`,{
          name:document.getElementById('name').value,
          active:document.getElementById('active').checked
            })
                .then(function(response) {  
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href="/cms/admin/categories";
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