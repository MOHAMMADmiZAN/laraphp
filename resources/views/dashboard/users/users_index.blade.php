@extends('dashboard.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card bg-gray mt-3">
                        <div class="card-header text-center"><h1>Users Details</h1></div>
                        <div class="card-body">
                            <table class="table table-striped text-center table-bordered mb-3">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>User Role</th>
                                    <th>User Photo</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td><img src="{{asset('assets/dist/upload').'/'.$user->profileImage}}" alt=""
                                                 width="50">
                                        </td>
                                        <td><a data-id="{{$user->id}}"
                                               class="btn btn-primary ml-1 us-edit">Edit</a><a
                                                href="javascript:void(0);" class="btn btn-danger ml-1">Delete</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$users}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerScript')
    <script>
        // select multiple class same name //
        let edit = document.getElementsByClassName('us-edit');
        for (let i = 0; i < edit.length; i++) {
            edit[i].addEventListener('click', function (e) {
                e.preventDefault()
                let id = this.getAttribute('data-id');
                axios.get(`{{url('/user-edit')}}/${id}`).then(function (r) {
                    console.log(r.data.id)
                }).catch(function (e) {
                    console.log(e)
                })
            })
        }
    </script>
@endsection
