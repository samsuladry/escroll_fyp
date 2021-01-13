<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(asset('css/backend.css')) }}

    @stack('after-styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
    @include('backend.moe.includes.headerMoe')
    <div class="app-body">
        @include('backend.moe.includes.sidebarMoe')

        <main class="main">
            @include('includes.partials.read-only')
            @include('includes.partials.logged-in-as')
          

            <div class="container-fluid" >
                <div class="animated fadeIn">
                    <div class="content-header" style="margin-bottom: 2em;">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(asset('js/manifest.js')) !!}
    {!! script(asset('js/vendor.js')) !!}
    {!! script(asset('js/backend.js')) !!}
    @stack('after-scripts')
</body>
</html>
