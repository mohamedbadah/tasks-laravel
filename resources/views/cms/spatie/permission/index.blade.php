@extends('cms.parent')
@section('main_page','lsit of permissions')
@section('page_title',"list permissions")
@section('small_page',"list permissions")
@section('content')
<div class="col-12">
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap table-border">
        {{-- @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{session('success')}}</strong> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        @endif --}}
        <thead>
          <tr>
            <th>ID</th>
            <th>name</th>
            <th>guard</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($permissions as $permission)
          <tr class="p-3">
            <td>{{$permission->id}}</td>
            <td style="mt-4">{{$permission->name}}</td>
            <td style="mt-4">{{$permission->guard_name}}</td>
            <td style="mt-4">{{$permission->permissions_count}}</td>
            <td>{{$permission->created_at}}</td>
            <td>{{$permission->updated_at}}</td>
            <td><a href="{{route('permission.edit',$permission->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <button onclick="confirm({{$permission->id}},this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
        axios.delete(`/cms/admin/permission/${id}`
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