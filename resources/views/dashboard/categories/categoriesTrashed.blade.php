@extends('dashboard.master')
@section('headerCss')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection();
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card bg-secondary my-3">
                        <div class="card-header text-center"><h5>View Category Data</h5></div>
                        <div class="card-body p-3">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th>#SR</th>
                                    <th>CATEGORY NAME</th>
                                    <th>SLUG</th>
                                    <th>CREATE AT</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categoryData as $key=> $data)
                                    <tr>
                                        <td>{{$categoryData->firstItem()+$key}}</td>
                                        <td>{{$data->categoryName}}</td>
                                        <td>{{$data->slug}}</td>
                                        <td>{{$data->created_at}}
                                            ({{ $data->created_at !== NULL ?$data->created_at->diffForHumans():'N/A'}})
                                        </td>
                                        <td>
                                            <a href="{{route('categoriesRestore',$data->id)}}"
                                               class="btn btn-primary">Restore</a>
                                            <a href="{{route('categoriesDelete',$data->id)}}"
                                               class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"><h5>No Data Found</h5></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            {{$categoryData}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection()
@section('footerScript')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(session('restore'))
        toastr.info('{{session('restore')}}')
        @endif
        @if(session('force'))
        toastr.error('{{session('force')}}')
        @endif()
    </script>

@endsection();
