@extends('cms.parent')
@section('main_page','create')
@section('page_title',"create categories")
@section('small_page',"create categories")
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">create roles</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
<div class="card-body">
   <form>
    <div class="form-group">
        <label>minimal</label>
        <select id="guard" class="form-control">
            <option value="admin">admin</option>
            <option value="user">user</option>
        </select>
    </div>
    <div class="form-group">
        <label>name</label>
        <input type="text" class="form-control" id="name">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" onclick="store()" class="form-control">Store</button>
      </div>
   </form>
</div>
  </div>
@endsection
@section('script')
 <script>
   
   function store(){
    axios.post('/cms/admin/role',{
        name:document.getElementById('name').value,
        guard:document.getElementById('guard').value,

    }).then( function (response){
       console.log(response.data.message);
       toastr.success(response.data.message);
    } ).catch( function (error){
        toastr.error(error.response.data.message);
    } ).then( function (){

    })
   }
    // function store(){
    //             axios.post('/cms/admin/role',{
    //                 name:document.getElementById('name').value,
    //                 guard:document.getElementById('guard').value
    //    }
    //  ).then(function (response) {
    //         toastr.success(response.data.message)
    //          window.location.href="/cms/admin/role/"
    //         console.log(response);
    //     })
    //     .catch(function (error) {
    //         toastr.error(error.response.data.message)
    //         console.log(error);
    //     })
    //     .then(function () {
    //         // always executed
    //     });
    //         }
 </script>
@endsection