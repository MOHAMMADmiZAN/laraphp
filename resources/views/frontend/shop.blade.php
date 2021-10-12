@extends("frontend.view")
@section("frontend_content")
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="index-2.html">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-lg-10">
                    <div class="product-menu">
                        <ul class="nav">
                            <li>
                                <a class="active" data-toggle="tab" href="#all" style="margin-top: 15px">All product</a>
                            </li>
                            @foreach($categoryData as $data)
                                <li>
                                    <a data-toggle="tab" style="margin-top: 15px"
                                       href="#{{$data->id}}">{{$data->categoryName}}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-2">
                    <div class="filter-menu text-right">
                        <a href="javascript:void(0);" style="margin-top: 15px">Filter</a>
                    </div>
                </div>
            </div>
            <div class="row filter-active">
                <div class="col-12">
                    <div class="filter-wrap">
                        <div class="row">
                            <div class="product-filter col-lg-3 col-sm-6 col-12">
                                <h3 class="filter-title">Sort by</h3>
                                <ul class="sort-by">
                                    <li><a href="#">Default</a></li>
                                    <li><a href="#">Popularity</a></li>
                                    <li><a href="#">Average rating</a></li>
                                    <li><a href="#">Newness</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                </ul>
                            </div>
                            <!-- Product Filter -->
                            <div class="product-filter col-lg-3 col-sm-6 col-12">
                                <h3 class="filter-title">color filters</h3>
                                <ul class="color-filter">
                                    <li><a href="#">Black</a></li>
                                    <li><a href="#">Brown</a></li>
                                    <li><a href="#">Orange</a></li>
                                    <li><a href="#">red</a></li>
                                    <li><a href="#">Yellow</a></li>
                                </ul>
                            </div>
                            <!-- Product Filter -->
                            <div class="product-filter col-lg-3 col-sm-6 col-12">
                                <h3 class="filter-title">product tags</h3>
                                <ul class="product-tags">
                                    <li><a href="#">New</a></li>
                                    <li><a href="#">brand</a></li>
                                    <li><a href="#">black</a></li>
                                    <li><a href="#">white</a></li>
                                    <li><a href="#">Honey</a></li>
                                    <li><a href="#">table</a></li>
                                    <li><a href="#">Lorem</a></li>
                                    <li><a href="#">ipsum</a></li>
                                    <li><a href="#">dolor</a></li>
                                    <li><a href="#">sit</a></li>
                                    <li><a href="#">amet</a></li>
                                </ul>
                            </div>
                            <div class="product-filter col-lg-3 col-sm-6 col-12">
                                <h3 class="filter-title">Filter by Price</h3>
                                <div class="filter-price">
                                    <form action="#">
                                        <div id="slider-range"></div>
                                        <div class="row">
                                            <div class="col-7">
                                                <p>Price :
                                                    <input type="text" id="amount">
                                                </p>
                                            </div>
                                            <div class="col-5 text-right">
                                                <button>filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                        @foreach($productData as $data)
                            @includeIf('frontend.customComponent.product-list',['data'=>$data,'modId'=>'data'.$data->id])
                            @includeIf('frontend.customComponent.product-modal',['data'=>$data,'modId'=>'data'.$data->id])
                        @endforeach
                        <li class="col-12 text-center">
                            <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                        </li>
                    </ul>
                </div>
                @foreach($categoryData as $data)
                    <div class="tab-pane" id="{{$data->id}}">
                        <ul class="row">
                            @foreach($data->products as $d)

                                @includeIf('frontend.customComponent.product-list',['data'=>$d,'modId'=>"d".$d->id])


                                @includeIf('frontend.customComponent.product-modal',['data'=>$d,'modId'=>"d".$d->id])



                            @endforeach

                        </ul>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
    <!-- product-area end -->
    <!-- start social-newsletter-section -->
    <section class="social-newsletter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter text-center">
                        <h3>Subscribe Newsletter</h3>
                        <div class="newsletter-form">
                            <form>
                                <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end social-newsletter-section -->
@endsection
