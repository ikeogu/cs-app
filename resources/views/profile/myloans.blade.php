@extends('layouts.app')

@section('content')
@include('users.partials.header', [
    'title' => __('Hello') . ' '. auth()->user()->name,
    'description' => __('Loan History made so far!'),
    'class' => 'col-lg-7'
    ])




    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0 row">
                        <div class="col-6">
                         <h3 class="text-white mb-0">Loans History</h3>
                        </div>
                         <div class="col-6 text-left">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal2">Apply for loan</a>

                        </div>
                         <!--Loan Modal -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Apply for Loan
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('loan') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Choose Loan Type</label>
                                                        <select class="form-control" name="loan_id" id="loan_name">
                                                            @foreach ($loans as $item)
                                                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="amt">


                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input class="form-control form-control-alternative" name="amount" type="number" placeholder="How much do you need?" id="amount">

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Duration</label>
                                                        <select class="form-control" name="duration" id="duration">
                                                            <option value="30">30 days</option>
                                                            <option value="60">60 days</option>
                                                            <option value="90">90 days</option>
                                                            <option value="120">120 days</option>
                                                            <option value="180">180 days</option>

                                                        </select>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="payback">

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Grantor's ID</label>
                                                        <input class="form-control form-control-alternative" name="grantor_code" type="text" required placeholder="" id="grantor_id">
                                                        <small><em>You must have a grantor whose monthly salary is greater than your loan reoccuring payment per month.</em></small>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="span_result">

                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea type="text" class="form-control form-control-alternative"
                                                            name="reason" placeholder="Reason...">

                                                                </textarea>

                                                    </div>
                                                </div>


                                            </div>

                                            <button type="submit" class="btn btn-primary">Apply</button>
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
                                <th scope="col" class="sort" data-sort="name">ID</th>
                                <th scope="col" class="sort" data-sort="name">Loan Type</th>
                                <th scope="col" class="sort" data-sort="budget">Amount</th>
                                <th scope="col" class="sort" data-sort="budget">Duration</th>
                                <th scope="col" class="sort" data-sort="budget">Monthly Payback</th>
                                <th scope="col" class="sort" data-sort="budget">Intrest</th>
                                <th scope="col" class="sort" data-sort="budget">Grantor</th>
                                 <th scope="col" class="sort" data-sort="budget">Reason</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>

                            
                            </tr>
                            </thead>
                            <tbody class="list">
                            <tr>
                                @foreach ($loans1 as  $id =>$item)
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
                                        {{ $item->gcode }}
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
                                    {{-- <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>--}}
                                    </td>
                                @endforeach
                            </tr>

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
  <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('change', '#loan_name', function() {

                var loan_id = $(this).val();
                var div = $(this).parent();
                var op = " ";
                $.ajax({
                    method: 'get',
                    url: '/find_loan/'+loan_id,
                    // data: {'id':loan_id},amount
                    success: function(data){
                        op += '<label>Amount Range</label><input class="form-control form-control-alternative" name="amount" readonly value="'+data.amount_range+'" > <label>Intrest Rate (%)</label><input class="form-control form-control-alternative" name="intrest" readonly value="'+data.intrest+'"  id="intrest"> ';

                        document.querySelector('#amt').innerHTML = op
                        console.log('success');
                    },
                    error: function(){
                        console.log('failed,something went wrong!');
                    },
                });
            });
        });
        var timeout = null;
        var minlength = 5;

        $("#grantor_id").keyup(function() {
                $('#span_result').html('<div class="loader">Loading...</div>');

                // clear last timeout check
                clearTimeout(timeout);

                var that = this;
                var value = $(this).val();
                var op = " ";

                if (value.length >= minlength) {
                    //
                    // run ajax call 1 second after user has stopped typing
                    //
                    timeout = setTimeout(function() {
                        $.ajax({
                            method: 'get',
                            url: '/find_grantor/'+value,
                            dataType: 'json',
                            contentType: 'application/json; charset=utf-8',
                            success: function(result) {
                                if (value == $(that).val()) {

                                    op += '<label>Garantor Name</label><input class="form-control form-control-alternative" name="grantor" readonly value="'+ result.name +'">'
                                    document.querySelector('#span_result').innerHTML = op
                                    console.log(result.name)

                                }
                            },
                            error: function(){
                                console.log('failed,something went wrong!');
                            },

                        });
                    }, 1000);
                }
            });

            // duration
         $(document).ready(function () {
            $(document).on('change', '#duration', function() {
                $('#payback').html('<div class="loader">Loading...</div>');

                var duration = parseInt($(this).val());

                var div = $(this).parent();
                var op = " ";
                var amount = parseInt(document.getElementById('amount').value);
                var intr = parseInt(document.getElementById('intrest').value)

                let payback = (amount/duration) * intr;
                 op += '<label>Monthly Payback </label><input class="form-control form-control-alternative" name="payback" readonly value="'+ Math.round(payback)+'" >';

                document.querySelector('#payback').innerHTML = op
            });
        });

    </script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
