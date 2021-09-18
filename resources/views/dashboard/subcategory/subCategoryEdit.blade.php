@extends('dashboard.master')
@section('headerCss')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection();
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Edit SUB-CATEGORY</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('subCategoryEditResponse',$subCategoryDataEdit->id)}}">
                            @csrf
                            <input type="hidden" name="subId" value="{{$subCategoryDataEdit->id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="subCategoryName">SUB-CATEGORY NAME </label>
                                    <input type="text"
                                           class="form-control @error('subCategoryName') is-invalid @enderror"
                                           id="subCategoryName" name="subCategoryName"
                                           value="{{$subCategoryDataEdit->subcategoryName}}"
                                           placeholder="Ex:Pen">
                                </div>
                                @error('subCategoryName')
                                <div class="alert alert-danger text-center text-uppercase">{{ $message }}</div>
                                @enderror
                                <label for="categoryChoose"></label>
                                <select name="categoryChoose"
                                        class="form-control @error('categoryChoose') is-invalid @enderror"
                                        id="categoryChoose">
                                    <option value=>Choose Your Category</option>
                                    @foreach($categoryData as $data)
                                        <option
                                            {{$subCategoryDataEdit->categoryId === $data->id? "selected":""}} value="{{$data->id}}">{{$data->categoryName}}</option>
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
        </div>
    </div>
@endsection()
@section('footerScript')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(session('success'))
        toastr.success('{{session('success')}}')
        @endif

    </script>

@endsection();
