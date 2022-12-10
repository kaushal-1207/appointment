<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Create Availibility</title>

</head>

<body>
    @include('nav')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-secondary" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form action="submit_form" method="POST">
                            @csrf
                            <input type="hidden" name="d_id" value="{{session('user')['user_id']}}">

                            <div class="form-group">
                              <label for="">Date</label>
                              <input type="date"
                                class="form-control" name="date" id="date" aria-describedby="helpId" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="">Select Time Slot</label>
                                <select class="form-control" name="time" id="time" required>
                                    <option value="" selected disabled>-- Select --</option>
                                    <option value="10 AM - 11 AM">10 AM - 11 AM</option>
                                    <option value="11 AM - 12 PM">11 AM - 12 PM</option>
                                    <option value="12 PM - 1 PM">12 PM - 1 PM</option>
                                    <option value="2 PM - 3 PM">2 PM - 3 PM</option>
                                    <option value="3 PM - 4 PM">3 PM - 4 PM</option>
                                    <option value="4 PM - 5 PM">4 PM - 5 PM</option>
                                    <option value="5 PM - 6 PM">5 PM - 6 PM</option>
                                    <option value="6 PM - 7 PM">6 PM - 7 PM</option>
                                    <option value="7 PM - 8 PM">7 PM - 8 PM</option>
                                </select>
                            </div>

                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        <h4>Show Availibility</h4>
        <table class="table table-striped table-inverse table-responsive mt-3">
            <thead class="thead-inverse text-center">
                <tr>
                    <th>Sr No</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($availibilitydetails as $availibilitydetail)
                    <tr>
                        <td scope="row">{{$availibilitydetail['primarykey']}}</td>
                        <td>{{$availibilitydetail['date']}}</td>
                        <td>{{$availibilitydetail['time']}}</td>
                    </tr>
                    @endforeach
                </tbody>
        </table>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 3000);

        });
    </script>

</body>

</html>