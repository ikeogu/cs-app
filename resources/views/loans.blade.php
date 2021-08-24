@extends('layouts.app')

@section('content')
 @include('layouts.headers.cards')

    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-10 mb-5 mb-xl-0">
               <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Loan History</h3>
                            </div>
                            {{-- <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Month</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">duration</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as  $id =>$item)
                                    <tr>
                                        <th scope="row">
                                            {{ $item->created_at->format('d M') }}
                                        </th>
                                        <td>
                                            {{ $item->amount }}
                                        </td>
                                        <td>
                                            {{ $item->duration }}
                                        </td>
                                        <td>
                                            <i class="fas fa-arrow-up text-success mr-3"></i>
                                            @if($item->status == 1)
                                               Approved
                                            @elseif($item->status == 2)
                                              In progress
                                            @elseif($item->status == 3)
                                              Awaiting approval
                                            @elseif($item->status == 4)
                                                Not approved
                                            @endif
                                        </td>
                                         <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" data-toggle="modal"
                                                        data-target="#modal-form-{{$id}}">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                        <!--Loan Modal -->
                                        <div class="col-md-4">

                                            <div class="modal fade" id="modal-form-{{$id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="modal-form" aria-hidden="true">
                                                <div class="modal-dialog modal- modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-body p-0">

                                                            <div class="card bg-secondary shadow border-0">

                                                                <div class="card-body px-lg-5 py-lg-5">

                                                                    <form role="form" action="{{ route('loanStatus') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="form-group mb-3">
                                                                            <div
                                                                                class="input-group input-group-alternative">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i
                                                                                            class="ni ni-email-83"></i></span>
                                                                                </div>
                                                                                <select class="form-control" name="status">
                                                                                    <option value="1">Approve</option>
                                                                                    <option value="2">In progress</option>
                                                                                    <option value="3">Awating approval
                                                                                    </option>
                                                                                    <option value="4">Decline</option>
                                                                                </select>
                                                                                <input name="id" value="{{ $item->id }}"
                                                                                    type="hidden">
                                                                            </div>
                                                                        </div>


                                                                        <div class="text-center">
                                                                            <button type="submit"
                                                                                class="btn btn-success my-4">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
