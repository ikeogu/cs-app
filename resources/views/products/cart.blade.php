@extends('layouts.app', ['title' => __('product page')])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
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
    </div>


    <div class="container-fluid mt--7">
     <div class="row">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0 row">

               <div class="col-6">
                     <h3 class="text-white mb-0">Shopping Cart has {{Session::has('cart') ? Session::get('cart')->totalQty : 0}} Items</h3>

                </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Product Items</th>
                    <th scope="col" class="sort" data-sort="budget">Actions</th>
                    <th scope="col" class="sort" data-sort="status">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col" class="sort" data-sort="completion">Total Price</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                    @if(session()->has('cart'))
                         @foreach($products as $product)
                          <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <a href="#" class="avatar rounded-circle mr-3">
                                    <img alt="Image placeholder" src="storage/products/cover_images/{{$product['item']['image']}}">
                                    </a>
                                    <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$product['item']['title']}}</span>
                                    </div>
                                </div>
                            </th>
                            <td>
                            <div class="avatar-group">

                                <a  class="btn btn-sm  btn-warning " href="{{route('reduceByOne',[$product['item']['id']])}}"  title="Decrease quantity"><b><i class="ni ni-fat-delete"></i>

                                </a>
                                 <a  class="btn btn-sm  btn-success " href="{{route('addItemByOne',[$product['item']['id']])}}"  title="Increase quantity"><b><i class="ni ni-fat-add"></i>

                                </a>
                                 <a class="btn btn-sm  btn-danger " href="{{route('removeItem',[$product['item']['id']])}}"  id="decrease"
                                  value="Decrease Value" title="Remove from Cart"><b><i class="ni ni-fat-remove"></i>

                                </a>

                            </div>
                         </td>
                        <td>
                        <span class="badge badge-dot mr-4">
                            {{$product['qty']}}
                        </span>
                        </td>

                    <td>
                      <div class="d-flex align-items-center">
                        {{$currency.''.number_format($product['item']['price']/100,2)}}
                      </div>
                    </td>
                    <td class="text-left">
                      {{$currency.''.number_format($totalPrice,2)}}
                    </td>
                  </tr>

                    @endforeach

                </tbody>
              </table>
              @else
                <h5 class="text-white"> Your Cart is Empty!</h5>
                @endif
            </div>
          </div>
          <div class="card-footer">
              <div class="row">
                <div class="col-6">
                    <a class="btn btn-outline-info btn-fill btn-sm" href="{{route('MP')}}">Continue Shopping</a>
                </div>
                <div class="col-6">
                    <a class="btn btn-outline-danger btn-fill btn-sm" href="{{route('emptyCart')}}">Empty Cart</a>
                </div>
              </div>
              <hr class="">
              <div class="row">
                @if(session()->has('cart') )
                  <div class="col-4">
                    <a class="btn btn-outline-primary  btn-sm btn-fill" href="{{route('checkout')}}">Proceed to Checkout</a>
                  </div>


                @endif
              </div>
          </div>
        </div>

      </div>
        @include('layouts.footers.auth')
    </div>
@endsection
