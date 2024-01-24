<!doctype html>
<html lang="en">
    @include('partials.header')

    <body>
        @include('partials.navbar')
        <div class="container-fluid mt-5 p-5">
            @yield('content')
        </div>

        @include('partials.script')
    </body>

</html>
