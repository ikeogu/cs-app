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
                     <h3 class="text-white mb-0"><a href="{{route('getCart')}}">Order Summary</a></h3>

                </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Product Items</th>

                    <th scope="col" class="sort" data-sort="status">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col" class="sort" data-sort="completion">Total Price</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                    @if(Session::has('cart'))
                         @foreach($products as $product)
                         @php
                           $ids = [];
                           array_push($ids,$product['item']['id'])
                          @endphp
                         @endphp
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

                @endif
                </tbody>
                <tfoot>
                     <tr>
                            <td></td>
                            <td></td>

                            <td><b>TOTAL</b></td>
                        <td><b>{{$currency.''.number_format($totalPrice,2)}}</b></td>
                    </tr>

                </tfoot>
              </table>

            </div>
          </div>
          <div class="card-footer">
              <div class="row">
             <form action="{{route('payH')}}" method="POST" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" class="form-control" value="{{auth()->user()->name}}"name="name" >
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputAddress">Email Address</label>
                    <input type="text" class="form-control" value="{{auth()->user()->email}}" name="email">
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" id="inputZip" value="{{auth()->user()->phone}}" name="phone">
                    </div>
                </div>
                <div class="form-group">

                </div>
                <input type="hidden" name="amount" value="{{$totalPriceCheckout}}">
                <input type="hidden" name="quantity" value="{{$totalQty}}">
                <input type="hidden" name="product_id" value="{{json_encode($ids)}}" >
                {{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                {{-- <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> --}} --}}

                 <div class="form-group row">


                    <div class="col-4">
                        <button type="submit" class="btn btn-sm btn-instagram btn-fill">Pay with Card</button>
                    </div>
                      {{-- <div class="col-4">
                          <a href="#" class="btn btn-primary btn-sm">Pay from Contribution</a>
                    </div> --}}
                      <div class="col-4 p--4">
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#exampleModal2">Purchase on Credit</a>
                    </div>
                </div>
                </form>
              </div>

               <!-- Modal purchase on credit -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Purchase Goods on Credit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>

      </div>
        @include('layouts.footers.auth')
    </div>
@endsection

