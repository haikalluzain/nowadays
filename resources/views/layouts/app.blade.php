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
    <link href="{{ asset('dist/modules/calendar/dist/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/components.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('dist/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/modules/popper.js') }}"></script>
    <script src="{{ asset('dist/modules/tooltip.js') }}"></script>
    <script src="{{ asset('dist/modules/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- General JS Scripts -->
    <script src="{{ asset('dist/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('dist/modules/moment.min.js') }}"></script>
    <script src="{{ asset('dist/modules/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('dist/modules/calendar/locale-all.js') }}"></script>
    <script src="{{ asset('dist/js/stisla.js') }}"></script>
  
  
    <!-- Template JS File -->
    <script src="{{ asset('dist/js/scripts.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <script>
        $('#fullcalendar').fullCalendar({
            defaultView: 'week',
            contentHeight: 200,
            locale: 'id',
            // header: false,
            header: {
                left: 'today',
                center: '',
                right: 'title',
            },
            eventAfterAllRender: function(view) {
                if ($('.label').length == 0) {
                    $('.fc-left').html('<div class="font-weight-bold" style="font-size: 16px">Kegiatan minggu ini</div>');
                }
            },
            eventLimit: true,
            displayEventTime: false,
            views: {
                week: {
                    type: 'basic',
                    eventLimit: 4,
                    titleFormat: 'D MMMM YYYY',
                    // titleRangeSeparator: ' sampai ',
                    duration: { weeks: 1 }
                }
            },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: "{{ url('/api/event/show') }}",
                    method: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        start: start.unix(),
                        end: end.unix(),
                    },
                        success: function(result){
                            var event = [];
                            $(result.events).each(function() {
                                event.push({
                                    title: $(this).attr('title'),
                                    description: $(this).attr('description'),
                                    start: $(this).attr('start'),
                                    end: $(this).attr('end'),
                                    color: $(this).attr('color'),
                                });
                            });
                        callback(event);
                    }
                });
            }
        })

    </script>
</body>
</html>
