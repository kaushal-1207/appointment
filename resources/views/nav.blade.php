<style>
    div#navbarNavDropdown {
        justify-content: space-between;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}" aria-current="page"
                            href="/dashboard">Dashboard</a>
                    </li>
                    @if (session('user')['role'] == 'Doctor')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'show_doctor_appointment' ? 'active' : '' }}" href="/show_doctor_appointment">Show Appointments</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'availibility' ? 'active' : '' }}" href="/availibility">Availibility</a>
                    </li>
                    @endif
                    @if (session('user')['role'] == 'Patient')
                        @if (session('patient_appointment') == 'Not Available')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'create_appointment' ? 'active' : '' }}" href="create_appointment">Create Appointment</a>
                        </li>
                        @else

                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'show_patient_appointment' ? 'active' : '' }}" href="/show_patient_appointment">Show Appointment</a>
                        </li>
                        @endif
                    @endif
    
                </ul>
            
            
            <ul class="navbar-nav">
                @if (session('user'))
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>
                            <b>{{Session::get('user')['user_name']}}</b>
                        </a>
                    </li>
                    <li class="nav-item nav-right">
                        <a class="nav-link" href="logout"> Logout</a>
                    </li>
                @else
                    <li class="nav-item nav-right">
                        <a class="nav-link" href="login"><i class="fa fa-user" aria-hidden="true"></i> Login</a>
                    </li>
                @endif
                
            </ul>
        </div>
    </div>
</nav>