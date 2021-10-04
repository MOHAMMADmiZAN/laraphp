@extends('dashboard.master')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-dark mt-3">
                <div class="card-header">Product Insert</div>
                <div class="card-body">
                    <form action="{{route("products.update",$products)}}" enctype="multipart/form-data" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="product_name">Products Name:</label>
                            <input type="text" id="product_name" name="product_name"
                                   class="form-control @error('product_name') is-invalid @enderror"
                                   placeholder="Type Products Name" value="{{$products->product_name}}">
                            @error('product_name')
                            <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Products Quantity:</label>
                            <input type="text" id="product_quantity" name="product_quantity"
                                   class="form-control @error('product_quantity') is-invalid @enderror"
                                   placeholder="Type Products Quantity" value="{{$products->product_quantity}}">
                            @error('product_quantity')
                            <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_description">Products Description:</label>
                            <textarea name="product_description" id="product_description"
                                      class="form-control @error('product_description') is-invalid @enderror"
                                      cols="30" rows="5">{{$products->product_description}}</textarea>
                            @error('product_description')
                            <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_price">Products Price:</label>
                            <input type="text" id="product_price" name="product_price"
                                   class="form-control @error('product_price') is-invalid @enderror"
                                   placeholder="Type Products Price" value="{{$products->product_price}}">
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
                                    <option
                                        {{$products->category_id === $data->id? "selected":""}} value="{{$data->id}}">{{$data->categoryName}}</option>
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
                                    <option
                                        {{$products->sub_category_id === $data->id? "selected":""}} value="{{$data->id}}">{{$data->subcategoryName}}</option>

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
                                   oninput="pic.src=window.URL.createObjectURL(this.files[0])"
                                   value={{asset("assets/dist/upload/products")."/".$products->product_photo}}>
                            @error('product_image')
                            <div class="alert alert-danger text-center text-uppercase mt-2">{{ $message }}</div>
                            @enderror

                            <img id="pic" width="100" height="100" alt="$products->product_photo"
                                 style="margin: 10px auto;"
                                 src="{{asset("assets/dist/upload/products")."/".$products->product_photo}}"/>

                        </div>
                        <button class="btn btn-secondary mt-5 w-100" type="submit">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
