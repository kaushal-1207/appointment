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
    <title>Create Appointment</title>

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
                        <form action="create_appointment_form" method="POST">
                            @csrf
                            <input type="hidden" name="p_id" value="{{session('user')['user_id']}}">
                            <div class="form-group">
                                <label for="">Select Doctor</label>
                                <select class="form-control" name="doctor_id" id="doctor_id" required>
                                    <option value="" selected>-- Select One --</option>
                                    @foreach ($doctordetails as $doctordetail)
                                        <option value="{{ $doctordetail['user_id'] }}">{{ $doctordetail['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Select Date</label>
                                <input type="date" name="a_date" id="a_date" class="form-control" placeholder=""
                                    aria-describedby="helpId">

                            </div>

                            <div class="form-group">
                                <label for="">Time Slot</label>
                                <select class="form-control" name="time_slot" id="time_slot" required>
                                    <option value="" selected>-- Select Time Slot --</option>
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

                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
