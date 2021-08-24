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
                                <h3 class="mb-0">Dividend Declaration</h3>
                            </div>
                            <div class="col-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">Add New Dividend</a>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Dividend</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('dividend') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">


                                                    <div class="form-group">
                                                        <input type="text" placeholder="Company"
                                                            class="form-control form-control-alternative" name="company" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="date" class="form-control form-control-alternative"
                                                            id="exampleFormControlInput1" placeholder="Announced"
                                                            name="announced">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="integer" placeholder="interim"
                                                            class="form-control form-control-alternative" name="Interim" />
                                                    </div>


                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control form-control-alternative"
                                                            id="exampleFormControlInput1"
                                                            placeholder="Final Dividend" name="final_div">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="number"
                                                            placeholder="Total dividend"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="total_div" />
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="number"
                                                            placeholder="Bonus"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="bonus" />
                                                    </div>
                                                </div>


                                            </div>

                                             <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="month"

                                                            class="form-control form-control-alternative is-valid"
                                                            name="closure_date" />
                                                    </div>
                                                </div>

                                            </div>
                                             <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="date"
                                                            placeholder="Payment Day"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="payment_d" />
                                                    </div>
                                                </div>


                                            </div>
                                             <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="date"
                                                            placeholder="Qualify Date"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="quali_date" />
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

                                    <th scope="col">Company</th>
                                    <th scope="col">Announced</th>
                                    <th scope="col">Interim</th>
                                    <th scope="col">Final Dividend</th>
                                    <th scope="col">Total Dividend</th>
                                    <th scope="col">Bonus</th>
                                     <th scope="col">Closure Date</th>
                                       <th scope="col">AGM</th>
                                         <th scope="col">Payment Day</th>
                                      <th scope="col">Qualification Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dividend as $item)
                                    <tr>
                                        <td>{{ $item->company }}</td>
                                        <td>
                                            {{ $item->announced }}</a>
                                        </td>
                                        <td># {{ $item->interim }}</td>
                                        <td>{{ $item->final_div }}</td>
                                        <td>{{ $item->total_div }}</td>
                                        <td>{{ $item->bonus }}</td>
                                        <td>{{ $item->closure_date }}</td>
                                        <td>{{ $item->agm }}</td>
                                        <td>{{ $item->payment_d }}</td>
                                        <td>{{ $item->quali_date }}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"  data-toggle="modal"
                                    data-target="#exampleModal1">Edit</a>

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
    @foreach ($dividend as $item)
         <!-- Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Financial Year</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('finance.update',[$item->id]) }}">
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
                                        <input type="type" class="form-control form-control-alternative"
                                            id="exampleFormControlInput1"
                                            name="description"
                                            value="{{$item->description}}"
                                            >
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="tel" value="{{$item->bd}}"
                                            class="form-control form-control-alternative" name="bd" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-alternative"
                                            id="exampleFormControlInput1"
                                            value="{{$item->bf}}" name="bf">
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
