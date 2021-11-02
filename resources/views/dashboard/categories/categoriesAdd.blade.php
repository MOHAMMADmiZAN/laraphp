@extends('dashboard.master');
@section('headerCss')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection();
@section('content')

    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ADD CATEGORY</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('categoriesPost')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoryName">CATEGORY NAME </label>
                                    <input type="text"
                                           class="form-control @error('categoryName') is-invalid @enderror"
                                           id="categoryName" name="categoryName"
                                           placeholder="Ex:Home">
                                </div>
                                <div class="custom-file">
                                    <label class="custom-file-label" for="customFile2" style="width:80%">Upload Category
                                        Image</label>
                                    <input type="file"
                                           class="custom-file-input @error('category_photo') is-invalid @enderror"
                                           id="customFile2" name="category_photo"
                                           oninput="pic2.src=window.URL.createObjectURL(this.files[0])">
                                    @error('category_photo')
                                    <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                    @enderror

                                    <img id="pic2" width="100" height="100" alt="No Preview"
                                         style="margin: 10px auto; position: absolute; top: -20px;right: 200px; border-radius: 5px; border: 3px solid black"
                                         src="{{asset('/assets/dist/upload/category/default.jpg')}}"/>

                                </div>
                                @error('categoryName')
                                <div class="alert alert-danger text-center text-uppercase">{{ $message }}</div>
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
    <!-- /.content -->

@endsection()
@section('footerScript')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(session('success'))
        toastr.success('{{session('success')}}')
        @endif

    </script>

@endsection();
