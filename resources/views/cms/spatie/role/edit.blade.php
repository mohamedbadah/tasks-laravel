@extends('cms.parent')
@section('main_page','Edit')
@section('page_title',"Edit categories")
@section('small_page',"Edit categories")
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
            <option @if ($role->guard_name=="admin")
                selected
            @endif>admin</option>
            <option @if ($role->guard_name=="user")
                selected
            @endif>user</option>
        </select>
    </div>
    <div class="form-group">
        <label>name</label>
        <input type="text" class="form-control" id="name" value="{{$role->name}}">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" onclick="update({{$role->id}})" class="form-control">update</button>
      </div>
   </form>
</div>
  </div>
@endsection
@section('script')
 <script>
   
   function update(id){
    axios.put(`/cms/admin/role/${id}`,{
        name:document.getElementById('name').value,
        guard_name:document.getElementById('guard').value,

    }).then( function (response){
       console.log(response.data.message);
       toastr.success(response.data.message);
       window.location.href="/cms/admin/role";
    } ).catch( function (error){
        toastr.error(error.response.data.message);
    } ).then( function (){

    })
   }
 </script>
@endsection