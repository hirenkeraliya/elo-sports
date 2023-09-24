<!doctype html>
<html lang="en">
<head>
    @include('admin.layouts._head')
</head>
<body>
<div class="wrapper">

    @include('admin.layouts._header')
    @include('admin.layouts._nav')

    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            @yield('title')
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            @yield('content')
        </div>
       @include('admin.layouts._footer')
    </div>
</div>

@include('admin.layouts._js')
</body>
</html>
