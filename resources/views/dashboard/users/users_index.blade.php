@extends('dashboard.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card  mt-3">
                        <div class="card-header bg-dark text-center"><h1>Users Details</h1></div>
                        <div class="card-body">
                            <table class="table table-striped text-center mb-3">
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
                                    <tr id="del_tbody{{$user->id}}">
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td id="{{'role'.$user->id}}">{{$user->role}}</td>
                                        <td><img src="{{asset('assets/dist/upload').'/'.$user->profileImage}}" alt=""
                                                 width="50">
                                        </td>
                                        <td>
                                            <button data-id="{{$user->id}}"
                                                    class="btn btn-primary ml-1 us-edit"{{in_array(Auth::user()->role,$admin_role)?'':"disabled"}}>
                                                Edit
                                            </button>
                                            <button data-id="{{$user->id}}"
                                                    class="btn btn-danger ml-1 us_del" {{in_array(Auth::user()->role,$admin_role)?'':"disabled"}}>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>

        document.title = 'User_Index'
        // select multiple class same name //
        let raw = document.getElementById('raw')
        let edit = document.getElementsByClassName('us-edit');
        let del = document.getElementsByClassName('us_del')
        let admin_roles = ['super-admin', 'admin'];
        let update_role = ['admin', 'moderator', 'user'];
        let auth_role = "{{Auth()->user()->role}}"
        // update loop
        for (let i = 0; i < edit.length; i++) {

            edit[i].addEventListener('click', function (e) {
                if (admin_roles.includes(auth_role)) {
                    e.preventDefault()
                    let id = this.getAttribute('data-id');
                    axios.get(`{{url('/user-edit')}}/${id}`).then(function (r) {
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
                        "{{auth()->id()}}" === id || auth_role === role_value ? btn.remove() : ''
                        auth_role === 'moderator' && role_value === 'admin' ? btn.remove() : ''
                        role.addEventListener('keyup', function (e) {
                            role_value = e.target.value
                            if (auth_role === role_value) {
                                btn.remove()
                            } else if (auth_role === 'moderator' && role_value === 'admin') {
                                btn.remove()
                            } else if (!update_role.includes(role_value)) {
                                btn.remove()
                            } else {
                                role_value = e.target.value
                                draw.after(btn)
                            }

                        })
                        let up_url = "{{route('user-edit-response')}}"
                        let role_th_id = '#role' + r.data[1].id
                        btn.addEventListener('click', function (e) {
                            axios.put(up_url, {id: r.data[1].id, role: role_value,}).then(function (r) {
                                if (r.status === 200) {
                                    let role_th = document.querySelector(role_th_id)
                                    role_th.innerHTML = r.data.role
                                    setTimeout(function () {
                                        raw.innerHTML = ''
                                    }, 500)
                                }
                            }).catch(function (e) {
                                console.log(e)
                            })

                        })
                    }).catch(function (e) {
                        console.log(e)
                    })
                } else {
                    alert(`You Are Not Allowed To Edit`)
                }
            })

        }
        // delete loop
        for (let i = 0; i < del.length; i++) {
            del[i].addEventListener('click', function (e) {
                if (admin_roles.includes(auth_role)) {
                    e.preventDefault()
                    let id = this.getAttribute('data-id');
                    let del_th_id = `del_tbody${id}`
                    let del_th = document.getElementById(del_th_id)
                    let del_url = `{{url('/user-delete')}}/${id}`
                    axios.delete(del_url).then(function (r) {
                        if (r.status === 200) {
                            if (r.data === 'Not Dumped') {
                                alert('You are not allowed to delete')
                            } else {
                                del_th.remove()
                            }
                        }
                        if (document.querySelector('tbody').childElementCount < 1) {
                            window.location.reload()
                        }

                    }).catch(function (e) {
                        console.log(e)
                    })
                } else {
                    alert("You are not allowed to delete")
                }
            })
        }
    </script>
@endsection
