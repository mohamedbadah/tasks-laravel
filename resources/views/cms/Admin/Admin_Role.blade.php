@extends('cms.parent')

@section('main_page',"$admin->name of Roles")
@section('page_title',"$admin->name of Roles")
@section('small_page',"$admin->name of Roles")
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
          @foreach ($roles as $role)
          <tr class="p-3">
            <td>{{$role->id}}</td>
            <td style="mt-4">{{$role->name}}</td>
            <td style="mt-4">{{$role->guard_name}}</td>
            <td style="mt-4">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" onchange="store({{$admin->id}},{{$role->id}})"  id="checkboxPrimary_{{$role->id}}" 
                    @if ($role->assigned)
                        checked
                    @endif
                    >
                    <label for="checkboxPrimary_{{$role->id}}">
                    </label>
                  </div>
            </td>
          </tr>  
          @endforeach  
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

    function store(adminId,role_Id){
        axios.post(`/cms/admin/admin/${adminId}/role`,
         {
            role_Id:role_Id
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