@extends('cms.parent')
@section('main_page','lsit of city')
@section('page_title',"list cities")
@section('small_page',"list cities")
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
            <th>active</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cities as $city)
          <tr>
            <td>{{$city->id}}</td>
            <td>{{$city->name}}</td>
            <td class="@if ($city->active) btn btn-success  @else btn btn-danger @endif">{{$city->status}}</td>
            <td>{{$city->created_at}}</td>
            <td>{{$city->updated_at}}</td>
            <td><a href="{{route('cities.edit',$city->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
             {{-- <form action="{{route('cities.destroy',$city->id)}}" method="POST" class="d-inline">
              @csrf
              @method("delete")
              <button onclick="return confirm('has you deleted')" type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
            </form> --}}
            <button onclick="confirm({{$city->id}},this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
  function confirm(id, referance) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    destroy(id, referance);
                }
            })

        }

        function destroy(id, referance) {
            axios.delete('/cms/admin/cities/'+id)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    referance.closest('tr').remove();
                    showMessage(response.data);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    showMessage(error.response.data);
                })


        }

        function showMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: data.text,
                showConfirmButton: false,
                timer: 1500
            })
        }
  </script>
@endsection