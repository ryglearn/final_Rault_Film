<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')
    <title>Rault Film | Detail Tv Shows</title>
</head>

<body>
    <div class="w-full h-screen flex flex-col relative">
        @php
            $backdropPath = $tvData ? "{$imageBaseURL}/original{$tvData->backdrop_path}" : '';
            // dd($tvData, $backdropPath);
        @endphp
        {{-- IMAGE BACKGROUND --}}
        <img class="w-full h-screen absolute object-cover lg:object-fill" src="{{ $backdropPath }}">
        <div class="w-full h-screen absolute bg-black/60 z-10"></div>

        {{-- Header Section --}}
        <header class="w-full bg-transparent h-[96px] drop-shadow-lg flex flex-row items-center p-5 mb-10 z-10 ">
            <div class="w-1/3 pl-5 ">
                <a href="/movies"
                    class="uppercase text-base mx-5 text-white hover:text-rault-500 duration-200 font-inter text-header ">Movies</a>
                <a href="/tv-show"
                    class="uppercase text-base mx-5 text-white hover:text-rault-500 duration-200 font-inter text-header">TV
                    Show</a>
            </div>

            <div class="w-1/3 flex items-center justify-center ">
                <a href="/"
                    class="font-bold text-5xl font-quicksand text-white hover:text-rault-500 duration-200 text-header">RAULT
                    FILM</a>
            </div>

            <div class="w-1/3 flex flex-row justify-end pr-10">
                <a href="/search" class="group ">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28.525 27.475L22.9625 21.9C24.8885 19.6983 25.8834 16.8343 25.7372 13.9127C25.591 10.9911 24.315 8.24072 22.1787 6.24237C20.0425 4.24402 17.2132 3.15414 14.2883 3.20291C11.3635 3.25167 8.57212 4.43526 6.50367 6.50371C4.43521 8.57217 3.25163 11.3636 3.20286 14.2884C3.1541 17.2132 4.24397 20.0425 6.24233 22.1788C8.24068 24.315 10.9911 25.591 13.9126 25.7372C16.8342 25.8835 19.6983 24.8885 21.9 22.9625L27.475 28.525C27.6142 28.6642 27.803 28.7425 28 28.7425C28.1969 28.7425 28.3857 28.6642 28.525 28.525C28.6642 28.3858 28.7424 28.1969 28.7424 28C28.7424 27.8031 28.6642 27.6142 28.525 27.475ZM4.74996 14.5C4.74996 12.5716 5.32178 10.6866 6.39313 9.08319C7.46447 7.47981 8.98721 6.23013 10.7688 5.49218C12.5504 4.75422 14.5108 4.56114 16.4021 4.93734C18.2934 5.31355 20.0307 6.24215 21.3942 7.60571C22.7578 8.96927 23.6864 10.7066 24.0626 12.5979C24.4388 14.4892 24.2457 16.4496 23.5078 18.2312C22.7698 20.0127 21.5201 21.5355 19.9168 22.6068C18.3134 23.6782 16.4283 24.25 14.5 24.25C11.9151 24.2467 9.43708 23.2184 7.60932 21.3906C5.78155 19.5629 4.75326 17.0848 4.74996 14.5Z"
                            class="fill-white group-hover:fill-rault-500 duration-200"></path>
                    </svg>
                </a>
            </div>
        </header>

        @php
            $title = '';
            $tagline = '';
            $year = '';
            $duration = '';
            $rating = 0;

            if ($tvData) {
                $originalDate = $tvData->first_air_date;
                $timestamp = strtotime($originalDate);
                $year = date('Y', $timestamp);
                $rating = (int) ($tvData->vote_average * 10);
                $title = $tvData->name;

                if ($tvData->tagline) {
                    $tagline = $tvData->tagline;
                } else {
                    $tagline = $tvData->overview;
                }

                if ($tvData->episode_run_time) {
                    // $hour = (int) ($tvData->episode_run_time / 60);
                    // $minute = $tvData->episode_run_time % 60;
                    $runtime = $tvData->episode_run_time[0];
                    $duration = "{$runtime}m / Episode";
                }
            }
            // 2 phi r    r = 32px
            $circumference = ((2 * 22) / 7) * 32;
            $progressrating = $circumference - ($rating / 100) * $circumference;

            $trailerID = '';
            if (isset($tvData->videos->results)) {
                foreach ($tvData->videos->results as $item) {
                    if (strtolower($item->type) == 'trailer') {
                        $trailerID = $item->key;
                        break;
                    }
                }
            }
        @endphp

        {{-- Content Section --}}
        <div class="w-full h-full z-10 flex flex-col justify-center px-20">
            <span class="font-quicksand font-bold text-6xl mt-4 text-white">{{ $title }}</span>
            <span
                class="font-inter italic max-w-3xl line-clamp-5 text-2xl mt-4 text-white mb-3 ">{{ $tagline }}</span>

            <div class="flex flex-row mt-4 items-center">
                {{-- Rating  --}}
                <div class="w-20 h-20 rounded-full flex items-center justify-center mr-4" style="background: #00304D">
                    <svg class="w-20 h-20" viewBox="0 0 80 80">
                        <!-- Lingkaran Background -->
                        <circle style="color: #004f80" stroke-width="8" stroke="currentColor" fill="transparent" r="32"
                            cx="40" cy="40">
                        </circle>

                        <!-- Progress Bar -->
                        <circle style="color: #6FCF97" stroke-width="8" stroke-dasharray="{{ $circumference }}"
                            stroke-dashoffset="{{ $progressrating }}" stroke-linecap="round" stroke="currentColor"
                            fill="transparent" r="32" cx="40" cy="40" transform="rotate(-90 40 40)">
                        </circle>
                    </svg>
                    <span class="absolute font-inter font-bold text-xl text-white ">{{ $rating }}%</span>
                </div>

                <span
                    class="font-inter text-xl text-white bg-transparent rounded-md border border-white p-2 mr-4">{{ $year }}</span>

                @if ($duration)
                    <span
                        class="font-inter text-xl text-white bg-transparent rounded-md border border-white p-2 mr-4">{{ $duration }}</span>
                @endif
            </div>

            {{-- Trailer Button --}}
            @if ($trailerID)
                <button
                    class="w-fit bg-rault-500 text-white pl-4 pr-6 py-3 mt-5 font-inter text-xl flex flex-row rounded-lg items-center hover:drop-shadow-lg duration-200"
                    onclick="showTrailer(true)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.525 18.025C9.19167 18.2417 8.854 18.254 8.512 18.062C8.17067 17.8707 8 17.575 8 17.175V6.82499C8 6.42499 8.17067 6.12899 8.512 5.93699C8.854 5.74566 9.19167 5.75832 9.525 5.97499L17.675 11.15C17.975 11.35 18.125 11.6333 18.125 12C18.125 12.3667 17.975 12.65 17.675 12.85L9.525 18.025Z"
                            fill="white"></path>
                    </svg>
                    <span>Play Trailer</span>
                </button>
            @endif
        </div>

        <div class="absolute z-10 w-full h-screen p-20 bg-black flex flex-col" id="trailerWrapper">
            <button class="ml-auto group mb-4" onclick="showTrailer(false)">
                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                    <path
                        d="m12.45 37.65-2.1-2.1L21.9 24 10.35 12.45l2.1-2.1L24 21.9l11.55-11.55 2.1 2.1L26.1 24l11.55 11.55-2.1 2.1L24 26.1Z"
                        class="fill-white group-hover:fill-rault-500 duration-200"></path>
                </svg>
            </button>
            <iframe src="https://www.youtube.com/embed/{{ $trailerID }}?enablejsapi=1" id="youtubeVideo"
                title="{{ $tvData->name }} " frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen class="w-full h-full"></iframe>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // hide trailer
        $('#trailerWrapper').hide();

        function showTrailer(isVisible) {
            if (isVisible) {
                // show trailer
                $('#trailerWrapper').show();
            } else {
                //stop Trailer video
                $('#youtubeVideo')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' +
                    '","args":""}', '*');
                // hide trailer
                $('#trailerWrapper').hide();
            }
        }
    </script>

</body>

</html>
