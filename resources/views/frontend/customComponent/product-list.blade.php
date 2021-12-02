<li class="col-xl-3 col-lg-4 col-sm-6 col-12">
    <div class="product-wrap">
        <div class="product-img">
            <span>Sale</span>
            <img src="{{asset("assets/dist/upload/products/".$data->product_photo)}}" alt="">
            <div class="product-icon flex-style">
                <ul>
                    <li><a data-toggle="modal" data-target="#{{$modId}}"
                           href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                    <li><a href=""><i class="fa fa-heart"></i></a></li>
                    <li><a href=""><i class="fa fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{\Illuminate\Support\Facades\URL::signedRoute('single',[$data->id])}}">{{$data->product_name}}</a></h3>
            <p class="pull-left">৳{{$data->product_price}}</p>
            <ul class="pull-right d-flex">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star-half-o"></i></li>
            </ul>
        </div>
    </div>
</li>
