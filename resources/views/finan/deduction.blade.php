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
                                <h3 class="mb-0">Generate Deduction Fee Schedule</h3>
                            </div>
                            <div class="col-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">Deduction Fee Schedule</a>
                                {{-- <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#exampleModal2">Add from CSV/Excel</a>--}}
                            </div>

                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Generation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('GD') }}">
                                            @csrf


                                             <div class="row">
                                                 <em>Choose the month you want to generate deduction fee schedule</em>
                                                <div class="col-12">
                                                    <div class="form-group has-success">
                                                        <input type="month"
                                                            placeholder="Choose Month"
                                                            class="form-control form-control-alternative is-valid"
                                                            name="month" />
                                                    </div>
                                                </div>


                                            </div>
                                            <button type="submit" class="btn btn-primary">Generate</button>
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

                   @if ($deduction ?? '' > 0)
                         <div class="table-responsive">
                               <div class="col-6 text-left">
                                <a href="{{route('DD',[App\Models\Deduction::latest()->first()->month,App\Models\Deduction::latest()->first()->year])}}" class="btn btn-sm btn-primary" >ExportTOPDF</a>
                                {{-- <a href="" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#exampleModal2">Add from CSV/Excel</a>--}}
                            </div>
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>

                                    <th scope="col">Name</th>
                                    <th scope="col">Earns (monthly)</th>
                                    <th scope="col">Contributions (monthly)</th>
                                    <th scope="col">Unrecovered Loan</th>
                                    <th scope="col">Total </th>
                                    <th scope="col">Month</th>

                                      <th scope="col">Generated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deduction ?? '' as $item)
                                    <tr>

                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            {{ $item->earns }}</a>
                                        </td>
                                        <td># {{ $item->contribution }}</td>
                                        <td>{{ $item->unrecovered_loan}}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->month}}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"  data-toggle="modal"
                                    data-target="#exampleModal1">Edit</a>

                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                   @else
                        Kindly click on the Generate Shedule Button
                   @endif
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            <p>Generated Deduction Shedule</p>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
