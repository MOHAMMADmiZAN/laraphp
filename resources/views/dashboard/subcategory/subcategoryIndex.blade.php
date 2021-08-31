@extends('dashboard.master')
@section('headerCss')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection()
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
                                    <th> SUB CATEGORY NAME</th>
                                    <th>CATEGORY NAME</th>
                                    <th>CREATE AT</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subCategoryData as $key=> $data)
                                    <tr>
                                        <td>{{$subCategoryData->firstitem()+$key}}</td>
                                        <td>{{$data->subcategoryName}}</td>
                                        <td>{{$data->category->categoryName}}</td>
                                        <td>{{$data->created_at}}
                                            ({{ $data->created_at !== NULL ?$data->created_at->diffForHumans():'N/A'}})
                                        </td>
                                        <td><a href="{{Route('subCategoryEdit',$data->id)}}"
                                               class="btn btn-info">Edit</a>
                                            <a href=""
                                               class="btn btn-warning">Delete</a></td>
                                    </tr>
                                @endforeach
                                <tbody/>
                            </table>
                            {{$subCategoryData->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">ADD SUB-CATEGORY</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('subCategoryInsert')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="subCategoryName">SUB-CATEGORY NAME </label>
                                    <input type="text"
                                           class="form-control @error('subCategoryName') is-invalid @enderror"
                                           id="subCategoryName" name="subCategoryName"
                                           placeholder="Ex:Pen">
                                </div>
                                @error('subCategoryName')
                                <div class="alert alert-danger text-center text-uppercase">{{ $message }}</div>
                                @enderror
                                <label for="categoryChoose"></label>
                                <select name="categoryChoose"
                                        class="form-control @error('categoryChoose') is-invalid @enderror"
                                        id="categoryChoose">
                                    <option value>Choose Your Category</option>
                                    @foreach($categoryData as $data)
                                        <option value="{{$data->id}}">{{$data->categoryName}}</option>
                                    @endforeach
                                </select>
                                @error('categoryChoose')
                                <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                @enderror

                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection();
@section('footerScript')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(session('success'))
        toastr.success('{{session('success')}}')
        @endif

    </script>

@endsection();


