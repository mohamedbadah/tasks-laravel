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
          <label for="name">name</label>
          <input type="text" class="form-control" name="name" id="name"> 
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input type="text" class="form-control" name="email" id="email"> 
          </div>
          <div class="form-group">
            <label for="password">password</label>
            <input type="password" class="form-control" name="password" id="password"> 
          </div>
          <div class="form-group">
            <label for="cpassword">confirm password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword"> 
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
      axios.post('/cms/admin/user',{
        name:document.getElementById('name').value,
        email:document.getElementById('email').value,
        password:document.getElementById('password').value,
        cpassword:document.getElementById('cpassword').value,
      })
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