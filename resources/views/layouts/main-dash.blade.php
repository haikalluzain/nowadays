<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{ asset('image/logo/main.png') }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('dist/modules/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/modules/fontawesome/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/modules/bootstrap-social/bootstrap-social.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
  <link rel="stylesheet"
    href="{{ asset('dist/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/modules/izitoast/css/iziToast.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/modules/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/modules/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/modules/dropify/dist/css/dropify.css') }}">
  <link href="{{ asset('dist/modules/calendar/dist/fullcalendar.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/css/components.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/css/custom.css') }}" rel="stylesheet">

  <script src="{{ asset('dist/modules/jquery.min.js') }}"></script>

</head>

<body>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ asset('dist/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </div>
          </li>
        </ul>
      </nav>

      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        @yield('dash-content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Haikal Fikri
            Luzain</a>
        </div>
        <div class="footer-right">
          v2.1.0
        </div>
      </footer>
    </div>
  </div>


  <!-- Scripts -->
  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
  <script src="{{ asset('dist/modules/popper.js') }}"></script>
  <script src="{{ asset('dist/modules/tooltip.js') }}"></script>
  <script src="{{ asset('dist/modules/bootstrap/js/bootstrap.min.js') }}"></script>

  <!-- General JS Scripts -->
  <script src="{{ asset('dist/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('dist/modules/moment.min.js') }}"></script>
  <script src="{{ asset('dist/js/stisla.js') }}"></script>
  <script src="{{ asset('dist/modules/cleave-js/dist/cleave.min.js') }}"></script>
  <script src="{{ asset('dist/modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('dist/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
  <script src="{{ asset('dist/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('dist/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('dist/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
  <script src="{{ asset('dist/modules/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('dist/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

  <script src="{{ asset('dist/modules/sweetalert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('dist/modules/izitoast/js/iziToast.min.js') }}"></script>

  <script src="{{ asset('dist/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('dist/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('dist/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
  <script src="{{ asset('dist/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
  <script src="{{ asset('dist/modules/dropify/dist/js/dropify.min.js') }}"></script>


  <!-- Calendar JS -->
  <script src="{{ asset('dist/modules/calendar/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('dist/modules/calendar/dist/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('dist/modules/calendar/dist/cal-init.js') }}"></script>


  <!-- Template JS File -->
  <script src="{{ asset('dist/js/scripts.js') }}"></script>
  <script src="{{ asset('dist/js/custom.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

  <script type="text/javascript">
    $('.date-picker').datepicker({
            language: "id",
            calendarWeeks: true,
            todayHighlight: true
        });
        $('#fullcalendar').fullCalendar({
            customButtons: {
                newEvent: {
                    text: 'Add Event',
                    click: function () {
                        alert('Add Event clicked')
                    }
                }
            },
            header: {
                left: 'title',
                center: 'newEvent',
                right: 'prev,next'
            }
        });
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop image here or click'
            }
        });

  </script>

  @yield('script')

  @include('alert')

</body>

</html>