@extends('layouts.app', ['title' => __('All Users')])

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">

            {{-- <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>
                                        <span class="h2 font-weight-bold mb-0">350,897</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                                        <span class="h2 font-weight-bold mb-0">2,356</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last week</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                                        <span class="h2 font-weight-bold mb-0">924</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                    <span class="text-nowrap">Since yesterday</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                                        <span class="h2 font-weight-bold mb-0">49,65%</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
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
                                <h3 class="mb-0">Members Accounts</h3>
                            </div>
                            {{-- <div class="col-6 text-left">
                                <a class="btn btn-sm btn-primary" href="{{ route('creditAll') }}">Credit All Users</a>
                                <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#exampleModal2">Debit All Users</a>
                            </div> --}}

                        </div>


                        {{-- Model 2 --}}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import CSV File</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file" class="form-control">
                                            <br>
                                            <button class="btn btn-success">Import Data</button>
                                            {{-- <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a> --}}
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
                                    <th scope="col">Account No</th>
                                    <th scope="col">Main Balance</th>
                                    <th scope="col">Loan Balance</th>
                                    <th scope="col">Earns</th>
                                    <th scope="col">Contributes</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $key => $item)
                                    <tr>
                                        <td>{{ $item->user->name ?? ''}}</td>
                                        <td>
                                            <a href="mailto:{{ $item->email }}">{{ $item->acct_number }}</a>
                                        </td>
                                        <td>{{ $item->acct_bal }}</td>
                                        <td>{{ $item->loan_bal }}</td>
                                        <td>{{ $item->user->salary  ?? ''}}</td>
                                        <td>{{ $item->user->can_pay ?? ''}}%</td>
                                        <td>
                                            @if ($item->status === 1)
                                                <a class="btn btn-sm btn-success text-white">Active</a>
                                            @else
                                                <a class="btn btn-sm btn-danger text-white">Suspended</a>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    {{-- <a type="button" class="dropdown-item btn btn-info"
                                                        href="{{ route('credit', [$item->id]) }}">Credit</a>
                                                    <a type="button" class="dropdown-item btn btn-warning" href="#"
                                                        data-toggle="modal"
                                                        data-target="#exampleModal-{{ $key }}">Debit</a>--}}
                                                    <a type="button" class="dropdown-item btn btn-danger"
                                                        href="{{ route('suspend', [$item->id]) }}">Suspend</a>
                                                    <a type="button" class="dropdown-item btn btn-danger"
                                                        href="{{ route('unsuspend', [$item->id]) }}">Unsuspend</a>
                                                    <a class="dropdown-item btn btn-danger"
                                                        href="', [$item->id]) }}"  data-toggle="modal"
                                                        data-target="#exampleModal3-{{ $key }}">Delete</a>
                                                </div>

                                            </div>
                                        </td>
                                          <!--Debit  Modal -->
                                                <div class="modal fade" id="exampleModal-{{ $key }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Debit User
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="{{ route('debit') }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <div class="form-group">
                                                                                <input type="number"
                                                                                    placeholder="Amount to be debited"
                                                                                    class="form-control form-control-alternative"
                                                                                    name="amount" />
                                                                                <input type="hidden"
                                                                                    value="{{ $item->id }}" name="id">
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <button type="submit"
                                                                        class="btn btn-primary">Debit</button>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Delete  Modal -->
                                                <div class="modal fade" id="exampleModal3-{{ $key }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Account
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>Confirm</h5>
                                                                <p>Are you sure you want to delete?</p>


                                                                    <a href="{{route('del',[$item->id])}}"
                                                                        class="btn btn-primary">Ok</a>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

@endsection
