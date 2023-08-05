    <!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My Laravel Project')</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- font-awesome  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></head>
<body>
<header>
    <!-- Include the navigation bar -->
    @include('admins.layouts.partials.navbar')
</header>

{{--<aside>
    <!-- Include the sidebar -->
    @include('admins.layouts.partials.sidebar')
</aside>--}}

<main>

    @if(Session::has('error'))
        <div class="d-flex justify-content-center alert alert-danger">
            {{ Session::get('error') }}

    </div>
    @endif
    <!-- The content of each page will be placed here -->
    @yield('content')
</main>

<footer>
    <!-- Include the footer -->
    @include('admins.layouts.partials.footer')
</footer>

<!-- Include jQuery from CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap JavaScript from CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include JS files -->
<script src="{{ asset('assets/js/app.js') }}"></script>
<!-- Additional scripts or libraries can be added here -->

</body>
</html>
