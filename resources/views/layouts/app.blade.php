<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <style>
        /* FOR BANNER IMAGE SLIDING EFFECT IN BANNER SECTION */
        .slide {
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
        }

        .hidden {
            opacity: 0;
            transform: translateX(100%);
        }

        .active {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
</head>

<body>

    <div
        class="-z-10 inset-0 h-full w-full
    bg-[linear-gradient(to_right,#73737330_1px,transparent_1px),linear-gradient(to_bottom,#73737330_1px,transparent_1px)]
    bg-[size:20px_20px]">

        {{-- HEADER SECTION --}}
        @include('shared.header')
        {{-- MAIN CONTENT SECTION --}}
        <div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
        {{-- FOOTER SECTION --}}
        @include('shared.footer')
    </div>

</body>

</html>
