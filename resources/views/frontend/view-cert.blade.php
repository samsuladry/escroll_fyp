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

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}

        @stack('after-styles')
    </head>
    <body>
        @include('includes.partials.read-only')

        <div id="app">

            <div class="container">
                  <div class="row mb-4">
                    <div class="col">
                        <div class="card text-center" style="margin-top: 3em;">
                            <div class="card-header">
                                 E-Scroll
                            </div>
                            <div class="card-body" style="margin-top: 2em;">
                           
                                <img  src="{{ asset('img/iium_logo.png') }}" height="100" width="100">
                                <h3 style="margin-top: 1em;">By the authority of the Senate it is hereby certified that</h3>
                                <h1 style="margin-top: 1em;">{{$student->name}}</h1>
                                <h3>Having fulfilled all the requirements and having passed all the prescribed examinations has been conferred the degree of</h3>

                                <h1 style="margin-top: 1em;">{{$student->graduate_field->title}}</h1> <br>
                                
                                

                                    <div style="float: left;margin-top: 3em;">
                                    <img  src="{{ asset('img/aikol-dean.png') }}" height="150" width="150">
                                    <img  src="{{ asset('img/rector.png') }}" height="150" width="150">

                                    </div>
                                    
                                    <img style="margin-top: 3em; float: right;" src="{{asset('qrcode.png')}}" height="150" width="150">
                         
                            </div>
                        </div><!--card-->
                    </div><!--col-->
                </div><!--row-->
                
        
            </div><!-- container -->
        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}
        @stack('after-scripts')

        @include('includes.partials.ga')
    </body>
</html>
