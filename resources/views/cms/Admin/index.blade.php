@extends('cms.parent')
@section('main_page','lsit of cateogries')
@section('page_title',"list cateogries")
@section('small_page',"list cateogries")
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
            <th>Email</th>
            <th>roles</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($admins as $admin)
          <tr class="p-3">
            <td>{{$admin->id}}</td>
            <td style="mt-4">{{$admin->name}}</td>
            <td style="mt-4">{{$admin->email}}</td>
            <td style="mt-4"><a class="btn btn-primary" href="{{route('admin.role.index',$admin->id)}}">({{$admin->roles_count}}) roles</a></td>
            <td>{{$admin->created_at}}</td>
            <td>{{$admin->updated_at}}</td>
            <td><a href="{{route('admin.edit',$admin->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <button onclick="confirm({{$admin->id}},this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    destroy(id,ref)
  }
})
    }
  function destroy(id,ref){
    axios.delete(`/cms/admin/admin/${id}`)
    .then(function(response){
      console.log(response);
      showMessage(response.data);
      ref.closest('tr').remove();
    })
    .catch(function(error){
      console.log(error);
      showMessage(error.response.data);
    })
  }
  function showMessage(data){
    Swal.fire({
  icon: data.icon,
  title:data.title,
  text:data.text,
  showConfirmButton: false,
  timer: 1500
})
  }
  </script>
@endsection