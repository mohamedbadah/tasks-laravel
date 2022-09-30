@extends('cms.parent')
@section('main_page','Edit')
@section('page_title',"Edit password")
@section('small_page',"Edit password")
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Password</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create_form">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">current password</label>
          <input type="password" class="form-control" id="oldPassword"> 
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">new password</label>
            <input type="password" class="form-control" id="newPassword"> 
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">confirm password</label>
            <input type="password" class="form-control" id="CnewPassword"> 
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="button" onclick="updatePassword()" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
@section('script')
  <script>
     function updatePassword(){
      axios.put(`/cms/admin/updatePass`,{
        oldPassword:document.getElementById('oldPassword').value,
        newPassword:document.getElementById('newPassword').value,
        CnewPassword:document.getElementById('CnewPassword').value
      })
                .then(function(response) {  
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('create_form').reset();
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