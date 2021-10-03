@extends('dashboard.master')
@section("title")
@endsection
@section("headerCss")
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8 mt-2">
                    <div class="card card-dark text-center">
                        <div class="card-header">
                            Update Profile
                        </div>
                        <div class="card-body">
                            <form action="{{route('updateProfile',Auth::id())}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{Auth::id()}}">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                           value="{{Auth::user()->name}}">
                                    @error('name')
                                    <div class="alert alert-danger text-center text-uppercase">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                           value="{{Auth::user()->email}}">
                                    @error('email')
                                    <div class="alert alert-danger text-center text-uppercase">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="oldPassword">Old Password:</label>
                                    <input type="password" id="oldPassword" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror"
                                           placeholder="Type your Old password">
                                    @error('oldPassword')
                                    <div class="alert alert-danger text-center text-uppercase">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password:</label>
                                    <input type="password" id="newPassword" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror"
                                           placeholder="Type New password">
                                    @error('newPassword')
                                    <div class="alert alert-danger text-center text-uppercase">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="profileImage">Profile Image:</label>
                                    <input type="file" id="profileImage"
                                           oninput="pic.src=window.URL.createObjectURL(this.files[0])"
                                           name="profileImage" class="@error('profileImage') is-invalid @enderror">
                                    @error('profileImage')
                                    <div class="alert alert-danger text-center text-uppercase">{{ $message }}</div>
                                    @enderror
                                    <img id="pic" src="{{asset('assets/dist/upload').'/'.Auth::user()->profileImage}}"
                                         alt="{{Auth::user()->profileImage}}" width="100" height="100"/>
                                </div>

                                <button class="btn btn-secondary" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
@section("footerScript")
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(session('notMatch'))
        toastr.error('{{session('notMatch')}}')
        @endif
        @if(session('success'))
        toastr.success('{{session('success')}}')
        @endif;
    </script>
@endsection
