@extends('cms.parent')
@section('main_page','lsit of Roles')
@section('page_title',"list Roles")
@section('small_page',"list Roles")
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
            <th>permission</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
          <tr class="p-3">
            <td>{{$role->id}}</td>
            <td style="mt-4">{{$role->name}}</td>
            <td style="mt-4">{{$role->guard_name}}</td>
            <td style="mt-4">
              <a href="{{route('role.permission.index',$role->id)}}" class="btn btn-primary">({{$role->permissions_count}}) permission</a>
              </td>
            <td>{{$role->created_at}}</td>
            <td>{{$role->updated_at}}</td>
            <td><a href="{{route('role.edit',$role->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <button onclick="confirm({{$role->id}},this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
    function confirm(id,ref){
    Swal.fire({
        text:" You won't be able to revert this!",
        title:"Are you sure",
        icon:"warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result)=>{
        if(result.isConfirmed){
            destroy(id,ref)
        }
    })
    }
    function destroy(id,ref){
        axios.delete(`/cms/admin/role/${id}`
        ).then(function (response){
            showMessage(response.data);
            ref.closest("tr").remove();
        }).catch(function (error){
            console.log(error.response.data);
        })
    }
   function showMessage(data){
    Swal.fire({
        icon:data.icon,
        text:data.text,
        tilte:data.title
    })
   }
 </script>
@endsection