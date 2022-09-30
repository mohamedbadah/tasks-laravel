@extends('cms.parent')

@section('main_page',"$role->name of permission")
@section('page_title',"$role->name of permission")
@section('small_page',"$role->name of permission")
@section('styles')
<link rel="stylesheet" href="{{asset('cms//plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection
@section('content')
<div class="col-12">
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap table-border">
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{session('success')}}</strong> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        @endif
        <thead>
          <tr>
            <th>ID</th>
            <th>name</th>
            <th>guard</th>
            <th>status</th>
          </tr>
        </thead>
        <tbody>
          @if ($role->guard_name=="admin")
          @foreach ($Permissions as $permission)
          @if ($permission->guard_name=="admin")
          <tr class="p-3">
            <td>{{$permission->id}}</td>
            <td style="mt-4">{{$permission->name}}</td>
            <td style="mt-4">{{$permission->guard_name}}</td>
            <td style="mt-4">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" onchange="store({{$role->id}},{{$permission->id}})" id="checkboxPrimary_{{$permission->id}}" 
                    @if ($permission->assigned)
                        checked
                    @endif >
                    <label for="checkboxPrimary_{{$permission->id}}">
                    </label>
                  </div>
            </td>
          </tr>  
          @endif 
          @endforeach  
          @endif

          @if ($role->guard_name=="user")
          @foreach ($Permissions as $permission)
          @if ($permission->guard_name=="user")
          <tr class="p-3">
            <td>{{$permission->id}}</td>
            <td style="mt-4">{{$permission->name}}</td>
            <td style="mt-4">{{$permission->guard_name}}</td>
            <td style="mt-4">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" onchange="store({{$role->id}},{{$permission->id}})" id="checkboxPrimary_{{$permission->id}}" 
                    @if ($permission->assigned)
                        checked
                    @endif >
                    <label for="checkboxPrimary_{{$permission->id}}">
                    </label>
                  </div>
            </td>
          </tr>  
          @endif 
          @endforeach  
          @endif
       
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>  
@endsection
@section('script')
 <script>

    function store(roleId,permissionId){
        axios.post(`/cms/admin/role/${roleId}/permission`,
         {
            permission_Id:permissionId
         }
        ).then(function (response){
            toastr.success(response.data.message);
        }).catch(function (error){
            console.log(error.response.data);
            toastr.error(error.response.data.message);
        })
    }
 </script>
@endsection