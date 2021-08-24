@extends('layouts.app', ['title' => __('product page')])

@section('content')
  <div class="header bg-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
              <div class="row ">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('danger') }}
                </div>

            @endif
           </div>
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Market</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('MP')}}">Market</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Place</li>
                   <li class="breadcrumb-item active" aria-current="page">Items</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->title}}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
            <a href="{{route('getCart')}}" class="btn btn-sm btn-neutral">Cart <i class="ni ni-cart"></i>
                      <span><sup class="text-danger badge">{{Session::has('cart') ? Session::get('cart')->totalQty : 0}}</sup> </span></a>
              {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col-xl-9 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('product')  }} {{$product->TrackID}}</h3>
                        </div>
                    </div>

                    <div class="card-body">

                            <h6 class="heading-small text-muted mb-4">{{ __('Details') }}</h6>


                              <div class="pl-lg-4 row">
                                 @if($product->image)
                                    <div class="col-6">
                                        <img class="" alt="User Image"
                                            src="{{ asset('storage/products/cover_images/' . $product->image) }}"
                                            height="200" width="auto"
                                            ></a>
                                    </div>

                                    <div class="col-6">
                                        <h5>{{$product->title}}</h5>
                                        <h5>{{$product->color}}</h5>
                                        <h5>{{$product->size}}</h5>
                                        <h5>{{$product->model}}</h5>
                                        <h5>{{$product->qty}} in stock</h5>
                                        <h5> ₦{{$product->price}}</h5>
                                        <hr class="my-3">
                                        <em>{{$product->description}}</em>
                                        <br>
                                        <hr class="my-3">
                                        <div class="row">

                                                <form action="{{route('addToCart')}}" method="POST">
                                                    {{ csrf_field() }}

                                                    <input type="number" name="qty"  min="1" class="form-control form-control-alternative" placeholder="quantity"required>

                                                    <input type="hidden" name="id" value="{{$product->id}}"><br>
                                                    <button type="submit" class="text-white btn btn-primary btn-sm">
                                                        Add to Cart <i class=" text-white fa fa-shopping-cart"></i>
                                                    </button>

                                                </form>


                                        </div>
                                    </div>
                                @endif


                    </div>
                </div>
            </div>
        </div>


    </div>
     @include('layouts.footers.auth')
@endsection
