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
                                <h3 class="mb-0"><a href="{{route('LM')}}">Loan Manager</a> </h3>
                            </div>
                            <div class="col-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">Add New Loan</a>
                                {{-- <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#exampleModal2">Add from CSV/Excel</a> --}}
                            </div>

                        </div>



                    </div>

                     <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">ID</th>
                                <th scope="col" class="sort" data-sort="name">Loan Type</th>
                                <th scope="col" class="sort" data-sort="budget">Amount</th>
                                <th scope="col" class="sort" data-sort="budget">Duration</th>
                                <th scope="col" class="sort" data-sort="budget">Monthly Payback</th>
                                <th scope="col" class="sort" data-sort="budget">Intrest</th>
                                <th scope="col" class="sort" data-sort="budget">Grantor</th>
                                 <th scope="col" class="sort" data-sort="budget">Reason</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                 <th scope="col" class="sort" data-sort="status">Action</th>


                            </tr>
                            </thead>
                            <tbody class="list">
                            <tr>
                                @foreach ($loans as  $id =>$item)
                                <td class="budget">
                                    {{$item->code}}
                                    </td>
                                    <td class="budget">
                                    {{$item->loan->name}}
                                    </td>
                                    <td>
                                        {{ $item->amount }}
                                    </td>
                                    <td>
                                        {{ $item->duration }}
                                    </td>
                                    <td>
                                        {{ $item->payback }}
                                    </td>
                                    <td>
                                        {{ $item->intrest }}
                                    </td>
                                    <td>
                                        {{ $item->getGrantor($item->gcode) }}
                                    </td>
                                    <td>
                                        {{ $item->reason }}
                                    </td>
                                    <td>

                                        @if($item->status == 1)
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-success"></i>
                                                <span class="status">Approved</span>
                                            </span>
                                        @elseif($item->status == 4)
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-primary"></i>
                                                <span class="status">In progress</span>
                                            </span>
                                        @elseif($item->status == 3)
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span class="status">pending</span>
                                            </span>
                                        @elseif($item->status == 5)
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-danger"></i>
                                                <span class="status">Declined</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                    <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" data-toggle="modal"
                                    data-target="#exampleModal2-{{$id}}">Change status</a>

                                            </div>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>

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
 @foreach ($loans as $key =>$item)
    <div class="modal fade" id="exampleModal2-{{$key}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Loan Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('changeMemberStatus',[$item->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="status" class="form-control form-control-alternative">
                                            <option value="1"> Approved</option>
                                            <option value="4"> In Progress</option>
                                            <option value="3"> Pending</option>
                                            <option value="5"> Decline</option>
                                        </select>
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
