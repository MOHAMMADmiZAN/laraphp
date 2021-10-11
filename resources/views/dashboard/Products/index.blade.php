@extends('dashboard.master')
@section("headerCss")
@endsection
@section("title")
    Products
@endsection
@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-dark mt-3">
                        <div class="card-header text-center">Product Data</div>
                        <div class="card-body">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <td>Sl</td>
                                    <td>Name</td>
                                    <td>Quantity</td>
                                    <td>Category Name</td>
                                    <td>Subcategory Name</td>
                                    <td>Price</td>
                                    <td>Image</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productData as $key=> $data)
                                    <tr>
                                        <td>{{$productData->firstitem()+$key}}</td>
                                        <td>{{$data->product_name}}</td>
                                        <td>{{$data->product_quantity}}</td>
                                        <td>{{$data->category->categoryName}}</td>
                                        <td>{{$data->subcategory->subcategoryName}}</td>
                                        <td>{{$data->product_price}}</td>
                                        <td><img src="{{asset('assets/dist/upload/products').'/'.$data->product_photo}}"
                                                 alt="{{$data->product_photo}}"
                                                 width="100"></td>
                                        <td class="d-flex justify-content-between align-items-center">
                                            <a href="{{route("products.show",$data)}}" class="btn btn-info">Edit</a>
                                            <form action="{{route('products.destroy',$data)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger ml-1" type="submit" onclick="return confirm('Are You Sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$productData->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-dark mt-3">
                        <div class="card-header">Product Insert</div>
                        <div class="card-body">
                            <form action="{{route("products.store")}}" enctype="multipart/form-data" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="product_name">Products Name:</label>
                                    <input type="text" id="product_name" name="product_name"
                                           class="form-control @error('product_name') is-invalid @enderror"
                                           placeholder="Type Products Name">
                                    @error('product_name')
                                    <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product_quantity">Products Quantity:</label>
                                    <input type="text" id="product_quantity" name="product_quantity"
                                           class="form-control @error('product_quantity') is-invalid @enderror"
                                           placeholder="Type Products Quantity">
                                    @error('product_quantity')
                                    <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product_description">Products Description:</label>
                                    <textarea name="product_description" id="product_description"
                                              class="form-control @error('product_description') is-invalid @enderror"
                                              cols="30" rows="5"></textarea>
                                    @error('product_description')
                                    <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Products Price:</label>
                                    <input type="text" id="product_price" name="product_price"
                                           class="form-control @error('product_price') is-invalid @enderror"
                                           placeholder="Type Products Price">
                                    @error('product_price')
                                    <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="categoryChoose">Category</label>
                                    <Select id="categoryChoose" name="categoryChoose"
                                            class="form-control @error('categoryChoose') is-invalid @enderror">
                                        <option value>Select Product Your Category</option>
                                        @foreach ($categoryData as $data)
                                            <option value="{{$data->id}}">{{$data->categoryName}}</option>
                                        @endforeach
                                    </Select>
                                    @error('categoryChoose')
                                    <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subcategoryChoose">Sub-Category</label>
                                    <Select id="subcategoryChoose" name="subcategoryChoose"
                                            class="form-control @error('subcategoryChoose') is-invalid @enderror ">
                                        <option value>Select Product Your SubCategory</option>
                                        @foreach ($subcategoryData as $data)
                                            <option value="{{$data->id}}">{{$data->subcategoryName}}</option>
                                        @endforeach
                                    </Select>
                                    @error('subcategoryChoose')
                                    <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="custom-file">
                                    <label class="custom-file-label" for="customFile">Upload Product Image</label>
                                    <input type="file"
                                           class="custom-file-input @error('product_image') is-invalid @enderror"
                                           id="customFile" name="product_image"
                                           oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                    @error('product_image')
                                    <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                                    @enderror

                                    <img id="pic" width="100" height="100" alt="No Preview" style="margin: 10px auto;"
                                         src=""/>

                                </div>
                                <button class="btn btn-secondary mt-5 w-100" type="submit">Insert</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("footerScript")
@endsection
