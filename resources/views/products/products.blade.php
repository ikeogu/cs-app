@extends('layouts.app')

@section('content')

    <!-- Header -->
    <!-- Header -->
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
                  <li class="breadcrumb-item"><a href="#">Market</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Place</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{route('getCart')}}" class="btn btn-sm btn-neutral">Cart <i class="ni ni-cart"></i>
                      <span><sup class="text-danger badge">{{Session::has('cart') ? Session::get('cart')->totalQty : 0}}</sup> </span></a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center">
        <div class=" col ">
          <div class="card">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Market Place</h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">
                  @foreach ($products as $key => $item)
                    <div class="col-lg-4 col-md-6">
                        <div  class="btn-icon-clipboard" data-clipboard-text="active-40" title="{{$item->title}}">

                            <div class="row">
                                <div class="col-6">
                                    <img src="{{asset('storage/products/cover_images/'.$item->image)}}" height="150" width="auto">
                                </div>
                                <div class="col-6">
                                      <ul>
                                        <li class="text-sm">{{$item->title}}</li>
                                        <li class="text-sm">₦ {{$item->price}}</li>
                                        <li class="text-sm">{{$item->qty}} in stock</li>
                                    </ul>
                                        <form action="{{route('addToCart')}}" method="POST">
                                            {{ csrf_field() }}
                                            <label>Quantity <label>
                                            <input type="number" name="qty"  min="1" class="form-control form-control-alternative" placeholder="Number of copies"required>

                                            <input type="hidden" name="id" value="{{$item->id}}"><br>
                                            <button type="submit" class="text-white btn btn-primary btn-sm">
                                                Add to Cart <i class=" text-white fa fa-shopping-cart"></i>
                                            </button>

                                        </form>
                                        <a type="button" href="{{route('product.show',[$item->id])}}" class="btn btn-sm btn-block  btn-info text-sm ">View more</a>
                                </div>

                            </div>
                        </div>
                    </div>
                  @endforeach


              </div>
            </div>
          </div>
        </div>
      </div>

  @include('layouts.footers.auth')
    </div>

@endsection
