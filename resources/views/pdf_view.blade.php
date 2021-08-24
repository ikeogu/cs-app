<!doctype html>
<html>
<head>
  <meta charset="utf-8">

    <title>
        Deduction Schedule
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
   {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>


    <div class="container-fluid">

        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>

                        <th scope="col">Name</th>
                        <th scope="col">Earns (M)</th>
                        <th scope="col">Contributions (M)</th>
                        <th scope="col">Unrecovered Loan</th>
                        <th scope="col">Total </th>
                        <th scope="col">Month</th>

                            <th scope="col">Generated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dection  as $item)
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

                        </tr>

                        @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
