@extends('layouts.app', ['title' => __('Financial Year')])

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">

            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Means of Revenue</h5>
                                        <span class="h2 font-weight-bold mb-0">{{App\Models\Income::count()}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    {{-- <span class="text-nowrap">{{App\Models\Income::latest()->first()->created_at->diffForHumans() ?? ''}}</span> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Expenditure</h5>
                                        <span class="h2 font-weight-bold mb-0">{{App\Models\Expenditure::count()}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                    {{-- <span class="text-nowrap">{{App\Models\Expenditure::latest()->first()->created_at->diffForHumans() ?? ''}}</span> --}}
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
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
                                <h3 class="mb-0">Income Statement</h3>
                            </div>
                            <div class="col-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">Create New Income Statement</a>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Means of Income</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('income') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Revenue "
                                                            class="form-control form-control-alternative" name="revenue" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-alternative"
                                                            id="exampleFormControlInput1" placeholder="Description"
                                                            name="description">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" placeholder="Amount"
                                                            class="form-control form-control-alternative" name="amount" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="month" class="form-control form-control-alternative"
                                                            id="exampleFormControlInput1"
                                                            placeholder="month" name="month">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="text"
                                                            placeholder="Year"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="year" />
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">

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
                                    <th scope="col">Revenue</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Month</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($income as $item)
                                    <tr>
                                        <td>{{ $item->revenue }}</td>
                                        <td>
                                            {{ $item->description }}</a>
                                        </td>
                                        <td># {{ $item->amount }}</td>
                                        <td># {{ $item->month }}</td>
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
    <div class="row mt-3">

            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">Expenditure Statement</h3>
                            </div>
                            <div class="col-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal2">Add New Expense</a>
                                {{-- <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#exampleModal2">Add from CSV/Excel</a> --}}
                            </div>

                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Expenses</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('expense') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Expense "
                                                            class="form-control form-control-alternative" name="expense" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-alternative"
                                                            id="exampleFormControlInput1" placeholder="Description"
                                                            name="description">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" placeholder="Amount"
                                                            class="form-control form-control-alternative" name="amount" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="month" class="form-control form-control-alternative"
                                                            id="exampleFormControlInput1"
                                                            placeholder="month" name="month">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="text"
                                                            placeholder="Year"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="year" />
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">

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
                                    <th scope="col">Expenses</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Month</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expense as $item)
                                    <tr>
                                        <td>{{ $item->expense }}</td>
                                        <td>
                                            {{ $item->description }}</a>
                                        </td>
                                        <td># {{ $item->amount }}</td>
                                         <td># {{ $item->month }}</td>

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
    @foreach ($income as $item)
         <!-- Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Income </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('IncomeUpdate',[$item->id]) }}">
                            @csrf
                            @method('put')

                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Revenue "
                                            class="form-control form-control-alternative" name="revenue"  value="{{$item->revenue}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-alternative"
                                            id="exampleFormControlInput1" placeholder="Description"
                                            name="description"  value="{{$item->description}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" placeholder="Amount"
                                            class="form-control form-control-alternative" name="amount" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="month" class="form-control form-control-alternative"
                                            id="exampleFormControlInput1"
                                            placeholder="month" name="month" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-success">
                                        <input type="text"
                                            placeholder="Year"
                                            class="form-control form-control-alternative is-valid"
                                            name="year" value="{{$item->year}}"/>
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
    @foreach ($income as $item)
         <!-- Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Expense </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('ExpenseUpdate',[$item->id]) }}">
                            @csrf
                            @method('put')

                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Revenue "
                                            class="form-control form-control-alternative" name="expense"  value="{{$item->revenue}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-alternative"
                                            id="exampleFormControlInput1" placeholder="Description"
                                            name="description"  value="{{$item->description}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" placeholder="Amount"
                                            class="form-control form-control-alternative" name="amount" value="{$item->amount}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="month" class="form-control form-control-alternative"
                                            id="exampleFormControlInput1"
                                            placeholder="month" name="month" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-success">
                                        <input type="text"
                                            placeholder="Year"
                                            class="form-control form-control-alternative is-valid"
                                            name="year" value="{{$item->year}}"/>
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
