<!doctype html>
<html lang="en">

<head>
    <title>Doctor Appointment</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    @include('nav')
    {{-- <h2>{{ Session::get('user')['user_name'] }}</h2> --}}
    <div class="container mt-5">
        <table class="table table-striped table-inverse table-responsive mt-3">
            <thead class="thead-inverse text-center">
                <tr>
                    <th>Sr No</th>
                    <th>Patient Name</th>
                    <th>Patient Contact</th>
                    <th>Patient Address</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($appointmentdetails as $appointmentdetail)
                    <tr>
                        <td scope="row">{{$appointmentdetail['primarykey']}}</td>
                        <td>{{$appointmentdetail['p_name']}}</td>
                        <td>{{$appointmentdetail['p_mobile']}}</td>
                        <td>{{$appointmentdetail['p_addr']}}</td>
                        <td>{{$appointmentdetail['date']}}</td>
                        <td>{{$appointmentdetail['time']}}</td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>