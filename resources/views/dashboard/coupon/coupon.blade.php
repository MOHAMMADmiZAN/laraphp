@extends('dashboard.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-dark mt-3">
                        <div class="card-header bg-gradient-gray">
                            Coupon List
                        </div>
                        <div class="card-body">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Coupon</th>
                                    <th>Validity</th>
                                    <th>Discount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $i=> $coupon)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$coupon->coupon_name}}</td>
                                        <td>{{$coupon->validity}}</td>
                                        <td>{{$coupon->discount.'%'}}</td>
                                        <td><a href="{{route('coupon_delete',[$coupon->id])}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="card border-dark mt-3">
                        <div class="card-header bg-gradient-gray">
                            Add Coupon
                        </div>
                        <div class="card-body">
                            <form action="{{route('coupon_add')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="coupon_name">Coupon Name:</label>
                                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror"
                                           name="coupon_name"
                                           placeholder="Type Coupon-Name" id="coupon_name">
                                </div>
                                @error('coupon_name')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="coupon_validity">Coupon Validity:</label>
                                    <input type="date"
                                           class="form-control @error('coupon_validity') is-invalid @enderror"
                                           name="coupon_validity"
                                           placeholder="Coupon Validity" id="coupon_validity">
                                </div>
                                @error('coupon_validity')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="coupon_discount">Coupon Discount:</label>
                                    <input type="text"
                                           class="form-control @error('coupon_discount') is-invalid @enderror"
                                           name="coupon_discount"
                                           placeholder="Type percentage Of Discount" id="coupon_discount">
                                </div>
                                @error('coupon_discount')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary">Add Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
