@extends('layouts.app')

@section('content')
@include('users.partials.header', [
    'title' => __('Hello') . ' '. auth()->user()->name,
    'description' => __('Contribution History made so far!'),
    'class' => 'col-lg-7'
    ])




    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0 row">
                        <div class="col-6">
                             <h3 class="text-white mb-0">Contribution History</h3>
                        </div>
                         <div class="col-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal1">Apply for Withdrawal</a>

                        </div>
                          <!--Withdraw Modal -->
                        <div class="modal fade modal-primary" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Withdraw Fund
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('withdraw') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="number" placeholder="Amount to be withdrawn"
                                                            class="form-control form-control-alternative" name="amount" />

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <textarea type="text" class="form-control form-control-alternative"
                                                            name="reason"> Reason...

                                                                </textarea>

                                                    </div>
                                                </div>


                                            </div>

                                            <button type="submit" class="btn btn-default">Withdraw</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Month</th>
                                <th scope="col" class="sort" data-sort="amount">Amount</th>
                                <th scope="col" class="sort" data-sort="paid_via">Paid Via</th>
                                <th scope="col" class="sort" data-sort="budget">Reciept</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>

                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">

                                @foreach ($contributions as  $id =>$item)
                                 <tr>
                                    <td class="budget">
                                    {{$item->created_at->format('d, M')}}
                                    </td>
                                    <td>
                                        {{ $item->amount }}
                                    </td>
                                    <td>
                                        {{ $item->paid_via }}
                                    </td>
                                    <td>
                                        {{ $item->reciept }}
                                    </td>
                                    <td>

                                        @if($item->status == 1)
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-success"></i>
                                                <span class="status">Approved</span>
                                            </span>
                                        @elseif($item->status == 2)
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-primary"></i>
                                                <span class="status">In progress</span>
                                            </span>
                                        @elseif($item->status == 3)
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span class="status">pending</span>
                                            </span>
                                        @elseif($item->status == 4)
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-danger"></i>
                                                <span class="status">Declined</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->acct_bal }}
                                    </td>
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
