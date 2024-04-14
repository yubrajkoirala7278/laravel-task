<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JSON to CSV Export</title>
    {{-- jquery cdn --}}
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    {{-- Bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @toastifyCss
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/style.css') }}">
</head>

<body>
    {{-- content --}}
    @yield('content')

    {{-- script --}}
    @yield('script')

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    @toastifyJs
</body>
</body>

</html>
