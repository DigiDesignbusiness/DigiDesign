@component('admin.layouts.content')
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Orders List</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Image </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Product Title </th>
                                <th> Quantity </th>
                                <th> Payment Status </th>
                                <th> Delivery Status </th>
                                <th> Delivered </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td> {{ $order->id }} </td>
                                    <td> 
                                        <img src="/productImage/{{ $order->image }}" alt="{{ $order->title }}">    
                                    </td>
                                    <td> {{ $order->name }} </td>
                                    <td> {{ $order->email }} </td>
                                    <td> {{ $order->phone }} </td>
                                    <td> {{ $order->product_title }} </td>
                                    <td> {{ $order->quantity }} </td>
                                    <td> {{ $order->payment_status }} </td>
                                    <td> {{ $order->delivery_status }} </td>

                                    @if ($order->delivery_status == 'Processing')
                                    <td>
                                        <a href="{{ route('delivered', $order->id) }}" 
                                        class="btn btn-info btn-sm">Delivered</a>
                                    </td>
                                    @else
                                    <td>
                                        <span style="color:green !important">Delivered</span>
                                    </td>
                                    @endif                             
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endcomponent
