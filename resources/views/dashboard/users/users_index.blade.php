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
                                        <td>
                                            <button data-id="{{$user->id}}"
                                                    class="btn btn-primary ml-1 us-edit"{{Auth::user()->role=='super-admin'?'':"disabled"}}>
                                                Edit
                                            </button>
                                            <button data-id="{{$user->id}}"
                                                    class="btn btn-danger ml-1 us_del" {{Auth::user()->role=='super-admin'?'':"disabled"}}>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$users}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" id="raw"></div>
            </div>
        </div>
    </div>
@endsection
@section('footerScript')
    <script>
        // select multiple class same name //
        let raw = document.getElementById('raw')
        let edit = document.getElementsByClassName('us-edit');
        let del = document.getElementsByClassName('us_del')
        // update loop
        for (let i = 0; i < edit.length; i++) {
            edit[i].addEventListener('click', function (e) {
                e.preventDefault()
                let id = this.getAttribute('data-id');
                axios.get(`{{url('/user-edit')}}/${id}`).then(function (r) {
                    console.log(r)
                    raw.innerHTML = r.data[0]
                    let btn = document.createElement('button')
                    btn.classList.add('btn', 'btn-info', 'us_update')
                    btn.innerText = 'Update';
                    btn.setAttribute('id', r.data[1].id)
                    let draw = raw.lastElementChild.children[1].children[1]
                    draw.after(btn)
                    let role = document.querySelector('#us_role')
                    role.setAttribute('value', r.data[1].role)
                    let role_value = role.getAttribute('value')
                    console.log(role_value)
                    role.addEventListener('change', function (e) {
                        role_value = e.target.value

                    })
                    let up_url = "{{route('user-edit-response')}}"
                    btn.addEventListener('click', function (e) {
                        axios.put(up_url, {id: r.data[1].id, role: role_value,}).then(function (r) {
                            if (r.status === 200) {
                                window.location.reload()
                            }
                        }).catch(function (e) {
                            console.log(e)
                        })

                    })
                }).catch(function (e) {
                    console.log(e)
                })
            })
        }
        // delete loop
        let del_url = "{{route('user-delete')}}"
        let config = {
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"

            }

        }

        for (let i = 0; i < del.length; i++) {
            del[i].addEventListener('click', function (e) {
                e.preventDefault()
                let id = this.getAttribute('data-id');
                let data = {
                    id: id,
                }
                axios.post(del_url, data, config).then(function (r) {
                    console.log(r)
                    window.location.reload();
                }).catch(function (e) {
                    console.log(e)
                })
            })
        }
    </script>
@endsection
