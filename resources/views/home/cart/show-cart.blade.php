@extends('home.master')

@section('content')
    <section style="height: 100vh; margin-top:70px;">
        <div class="container">
            <h1 style="font-size: 20px">Product List</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php( $totalPrice = 0)
                    @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->product_title }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>{{ $cart->price }}</td>
                        <td><img src="/productImage/{{ $cart->image }}" alt="{{ $cart->product_title }}" style="width: 40px"></td>
                        <td>
                            <form action="{{ route('remove-cart-item', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="color: black">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @php($totalPrice = $totalPrice + $cart->price)
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <h1 style="font-size: 20px; font-weight:700;">Total Price: ${{ $totalPrice }}</h1>
            </div>
            <div class="text-center mt-4">
                <h1 style="font-size: 22px; font-weight:700;">Procced To Order</h1>
                <a href="{{ route('cash-order') }}" class="btn btn-danger ">Cash On Delivery</a>
                <a href="#" class="btn btn-danger ">Payment Using Card</a>
            </div>
        </div>
    </section>
@endsection
