@extends('dashboard.master')
@section('headerCss')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <div class="card bg-secondary my-3">
                        <div class="card-header text-center"><h5>View Sub Category Data</h5></div>
                        <div class="card-body p-3">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th>#SR</th>
                                    <th>SUB CATEGORY NAME</th>
                                    <th>CATEGORY NAME</th>
                                    <th>CREATE AT</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subCategoryTrashData as $key=> $data)
                                    <tr>
                                        <td>{{$subCategoryTrashData->firstitem()+$key}}</td>
                                        <td>{{$data->subcategoryName}}</td>
                                        <td>{{$data->category->categoryName}}</td>
                                        <td>{{$data->created_at}}
                                            ({{ $data->created_at !== NULL ?$data->created_at->diffForHumans():'N/A'}})
                                        </td>
                                        <td><a href="{{Route('subCategoryRestore',$data->id)}}"
                                               class="btn btn-primary">Restore</a>
                                            <a href="{{Route('subCategoryDeleted',$data->id)}}"
                                               class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                                <tbody/>
                            </table>
                            {{$subCategoryTrashData->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('footerScript')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(session('success'))
        toastr.success('{{session('success')}}')
        @endif
        @if(session('forceDeleted'))
        toastr.error('{{session('forceDeleted')}}')
        @endif
    </script>

@endsection
