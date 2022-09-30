@extends('cms.parent')
@section('main_page','update')
@section('page_title',"update categories")
@section('small_page',"update categories")
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">categories update</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
      <div class="card-body">
        <div class="form-group">
          <label for="name">name</label>
          <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name"> 
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input type="text" class="form-control" name="email" value="{{$user->email}}" id="email"> 
          </div>
          {{-- <div class="form-group">
            <label for="password">password</label>
            <input type="password" class="form-control" name="password" value="{{$user->password}}" id="password"> 
          </div>
          <div class="form-group">
            <label for="cpassword">confirm password</label>
            <input type="password" class="form-control" name="cpassword" value="{{$user->password}}" id="cpassword"> 
          </div>  --}}
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="update({{$user->id}})" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
@section('script')
  <script>
     function update(id){
      axios.put(`/cms/admin/user/${id}`,{
        name:document.getElementById('name').value,
        email:document.getElementById('email').value,
        // password:document.getElementById('password').value,
        // cpassword:document.getElementById('cpassword').value,
      })
                .then(function(response) {  
                    console.log(response);
                    toastr.success(response.data.message);
                    console.log(response.data.message);
                    window.location="/cms/admin/user";
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