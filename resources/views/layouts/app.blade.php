<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Wellmade Ventures') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
        
        <link rel='stylesheet' type='text/css' href='css/nifty.main.css'>
        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        <style type="text/css">
        .dataTables_scrollBody thead tr {
                visibility: collapse;
            }

            .dataTables_scrollBody {
                margin-top: 0px;
            }

            .swal2-container{
                z-index: 10000 !important;
            }
            .tableFixHead          { overflow: auto; height: 500px; }
            .tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
            
            /* Just common table stuff. Really. */
            table  { border-collapse: collapse; width: 100%; }
            th, td { padding: 8px 16px; }
            /* th     { background:#eee; } */
        </style>

    </head>
    <body>
       
        <div id="container" class="effect aside-float aside-bright mainnav-lg">
            @include('layouts.shared.header') 
            <div class="boxed">
                <div  id="content-container">
                    <div id="page-content">
                        <main>
                            {{ $slot }}
                        </main>
                    </div>
                </div>             
                @include('layouts.shared.main_nav')
            </div>
            @include('layouts.shared.footer')

             <!-- SCROLL PAGE BUTTON -->
            <!--===================================================-->
            <button class="scroll-top btn">
                <i class="pci-chevron chevron-up"></i>
            </button>
            <!--===================================================-->
            
        </div>

        @stack('modals')

        <!-- Scripts -->
        @livewireScripts
        <script type="text/javascript" src="{{ mix('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{ mix('js/main.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <!-- <script type="text/javascript" src="{{ asset('js/DataTable.js') }}"></script> -->
        @yield('custom_script') 
    </body>
</html>
