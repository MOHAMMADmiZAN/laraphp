<div class="modal fade" id="{{$modId}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body d-flex">
                <div class="product-single-img w-50">
                    <img src="{{asset("assets/dist/upload/products/".$data->product_photo)}}"
                         alt="">
                </div>
                <div class="product-single-content w-50">
                    <h3>{{$data->product_name}}</h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left"></span>
                        <ul class="rating pull-right">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li>(05 Customar Review)</li>
                        </ul>
                    </div>
                    <p>{{\Illuminate\Support\Str::substr($data->product_description,0,500)}}</p>
                    <form action="{{route('cart_store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$data->id}}">
                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input type="text" value="1" name="quantity"/>
                            </li>
                            <li>
                                <button type="submit" class="btn cart-btn-custom">
                                    Add to Cart
                                </button>
                            </li>
                        </ul>
                    </form>
                    <ul class="cetagory">
                        <li>Categories:</li>
                        <li>{{$data->category->categoryName}}</li>
                    </ul>
                    <ul class="socil-icon">
                        <li>Share :</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
