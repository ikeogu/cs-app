@extends('layouts.app', ['title' => __('All Products')])

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">

        </div>
    </div>

 <!-- Dark table -->
      <div class="row">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0 row">

               <div class="col-6">
                     <h3 class="text-white mb-0">Products</h3>
                    <form action="{{ route('filtItems') }}"  method="post">
                        @csrf
                        <div class="row">

                            <div class="mb-0 col-4" ><strong>Filter options (status): </strong></div>

                            <div class="col-4">

                                <select class="form-control form-control-alternative" name="status">
                                    <option value="any">Any</option>
                                    <option value="1">Sold on Cash</option>
                                    <option value="2">Sold on Credit</option>
                                    <option value="3"></option>
                                    <option value="4">Not Delivered</option>

                                </select>
                            </div>

                            <div class="col-4">

                                <input type="submit" value="Apply Filters" class="btn btn-primary btn-sm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Product</th>
                    <th scope="col" class="sort" data-sort="budget">Price</th>
                    <th scope="col" class="sort" data-sort="status">Status</th>
                    {{-- <th scope="col">Users</th>
                    <th scope="col" class="sort" data-sort="completion">Completion</th>
                    <th scope="col"></th> --}}
                  </tr>
                </thead>
                <tbody class="list">
                    @foreach ($products as  $item)
                          <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                          <img alt="Image placeholder" src="{{asset('storage/products/cover_images/'.$item->image)}}">
                        </a>
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{$item->title}}</span>
                        </div>
                      </div>
                    </th>
                    <td class="budget">
                      {{$item->price}}
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i>
                        <span class="status">sold</span>
                      </span>
                    </td>
                    {{-- <td>
                      <div class="avatar-group">
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                          <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                          <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                          <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                          <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                        </a>
                      </div>
                    </td> --}}
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="completion mr-2">60%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="#">Edit</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          <a class="dropdown-item" href="#">Change Status</a>
                        </div>
                      </div>
                    </td>
                  </tr>

                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
