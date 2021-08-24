@extends('layouts.app')

@section('content')
    @include('layouts.headers.usercard')

    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Transaction History</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Month</th>
                                    <th scope="col">Status</th>
                                     <th scope="col">% of Current Salary</th>
                                    <th scope="col">Amount</th>

                                    <th scope="col">Current Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $item->created_at->format('d M') }}
                                        </th>
                                         <td>
                                            {{ $item->status }}
                                        </td>
                                         <td>
                                            {{ $item->can_pay }}
                                        </td>
                                        <td>
                                            {{ $item->amount }}
                                        </td>

                                        <td>
                                            <i class="fas fa-arrow-up text-success mr-3"></i> {{ $item->acct_bal }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
             <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Loan History</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
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
                                @foreach ($loans as $item)
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class=" row mt-5">
              <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Withdrawal History</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Month</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawals as $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $item->created_at->format('d M') }}
                                        </th>
                                        <td>
                                            {{ $item->amount }}
                                        </td>
                                        <td>
                                            {{ $item->reason }}
                                        </td>
                                        <td>

                                            @if($item->status == 1)
                                              <i class="fas fa-arrow-up text-success mr-3"></i> Approved
                                            @elseif($item->status == 2)
                                             <i class="fas fa-arrow-up text-info mr-3"></i> In progress
                                            @elseif($item->status == 3)
                                             <i class="fas fa-arrow-down text-warning mr-3"></i> Awaiting approval
                                            @elseif($item->status == 4)
                                              <i class="fas fa-arrow-downn text-danger mr-3"></i>  Not approved
                                            @endif
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
