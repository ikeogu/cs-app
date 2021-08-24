@extends('layouts.app', ['title' => __('Financial Year')])

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">


        </div>
    </div>


    <div class="container-fluid mt--7">
        <div class="row">
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
        <div class="row">

            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">Loan Management</h3>
                            </div>
                            <div class="col-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">Add New Loan</a>
                                {{-- <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#exampleModal2">Add from CSV/Excel</a> --}}
                            </div>

                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Loan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('loan') }}">
                                            @csrf


                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="text"
                                                            placeholder="Name of loan"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="name" />
                                                    </div>
                                                </div>


                                            </div>

                                             <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="text"
                                                            placeholder="Amount Range"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="amount_range" />
                                                    </div>
                                                </div>

                                            </div>
                                             <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="text"
                                                            placeholder="Intrest Rate"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="intrest" />
                                                    </div>
                                                </div>


                                            </div>
                                             <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="type"
                                                            placeholder="Duration"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="duration" />
                                                    </div>
                                                </div>


                                            </div>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>

                                    <th scope="col">Name</th>
                                    <th scope="col">Amount Range</th>
                                    <th scope="col">Intrest</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Created</th>
                                     <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $key => $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            {{ $item->amount_range}}</a>
                                        </td>
                                        <td>% {{ $item->intrest }}</td>
                                        <td>{{ $item->duration }}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"  data-toggle="modal"
                                    data-target="#exampleModal1-{{$key}}">Edit</a>
                                    <a class="dropdown-item" href="{{route('SL',[$item->id])}}">view loans</a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($loans as $key => $item)
         <!-- Modal -->
        <div class="modal fade" id="exampleModal1-{{$key}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Loan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('loanUpdate',[$item->id]) }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="{{$item->name}}"                                                                                        class="form-control form-control-alternative" name="name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-alternative"
                                            id="exampleFormControlInput1"
                                            name="amount_range"
                                            value="{{$item->amount_range}}"
                                            >
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="{{$item->intrest}}"
                                            class="form-control form-control-alternative" name="intrest" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-alternative"
                                            id="exampleFormControlInput1"
                                            value="{{$item->duration}}" name="duration">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
