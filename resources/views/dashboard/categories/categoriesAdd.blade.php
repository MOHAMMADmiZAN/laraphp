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
                            <form method="POST" action="{{route('categoriesPost')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="categoryName">CATEGORY NAME </label>
                                        <input type="text"
                                               class="form-control @error('categoryName') is-invalid @enderror"
                                               id="categoryName" name="categoryName"
                                               placeholder="Ex:Home">
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
