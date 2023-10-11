@extends('home.master')

@section('content')
    <section class="arrival_section">
        <div class="container">
            <div class="box">
                <div class="arrival_bg_box" style="z-index:0 !important">
                    <img src="/productImage/{{ $product->image }}" alt="{{ $product->title }}">
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <div class="heading_container remove_line_bt">
                            <h2>
                                {{ $product->title }}
                            </h2>
                        </div>
                        <p style="margin-top: 20px;margin-bottom: 30px;">
                            {{ $product->description }}
                        </p>
                        @if ($product->discount != null)
                            <h6 style="color:red">
                                ${{ $product->discount }}
                            </h6>
                            <h6 style="text-decoration: line-through">
                                ${{ $product->price }}
                            </h6>
                        @else
                            <h6>
                                ${{ $product->price }}
                            </h6>
                        @endif
                        <form action="{{ route('add-cart', $product->id) }}" method="POST">
                           @csrf
                           <div class="row">
                              <div class="col-md-4">
                                 <input type="number" min="1" name="quantity" value="1" width="100px">
                              </div>
                              <div class="col-md-4">
                                 <input type="submit" value="Add To Cart" class="option2">
                              </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
