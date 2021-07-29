@extends('dashboard.master')
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
                                @foreach($categoryData as $key=> $data)
                                    <tr>
                                        <td>{{$categoryData->firstItem()+$key}}</td>
                                        <td>{{$data->categoryName}}</td>
                                        <td>{{$data->slug}}</td>
                                        <td>{{$data->created_at}}
                                            ({{ $data->created_at !== NULL ?$data->created_at->diffForHumans():'N/A'}})
                                        </td>
                                        <td>
                                            <a href="{{route('categoriesEdit',$data->id)}}"
                                               class="btn btn-info">Edit</a>
                                            <a href="{{route('categoriesSoftDelete',[$data->id])}}"
                                               class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
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