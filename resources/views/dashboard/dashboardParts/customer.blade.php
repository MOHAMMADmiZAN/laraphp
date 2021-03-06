@php
    $orders= \App\Models\OrderBillingDetails::whereUserId(auth()->id())->latest()->paginate(5);
@endphp


<div class="row ">
    <div class="col-lg-6 m-auto">
        <div class="card text-center ">
            <div class="card-header bg-dark">My Orders</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Order Price</th>
                        <th>Invoice</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $i=>$order)
                        <tr>
                            <td>{{$orders->firstItem()+$i}}</td>
                            <td>{{$order->order_id}}</td>
                            <td>{{$order->customer_name}}</td>
                            <td>{{$order->phone_number}}</td>
                            <td>BDT {{$order->order->total}}</td>
                            <td><a href="{{route('invoice_pdf',$order->order_id)}}" class="btn btn-info"><i
                                        class="fas fa-download"></i></a></td>
                        </tr>
                    @empty
                        <p>No Order </p>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
