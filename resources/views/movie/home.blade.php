@extends('layouts.app')
@section('title', 'Rault Film | No Movie No Life')
@section('content')
    <div class="h-full min-h-screen flex flex-col dasaran">
        {{-- banner section --}}
        <div class="w-full h-[512px] flex flex-col relative bg-black rounded-[32px]">

            {{-- banner data --}}
            @foreach ($banner as $bannerItem)
                @php
                    $bannerImage = "{$imageBaseURL}/original/{$bannerItem->backdrop_path}";
                @endphp
                <div class="flex flex-row items-center  w-full h-full relative slide ">

                    {{-- image --}}
                    <img src="{{ $bannerImage }}" class="absolute w-full h-full object-cover  rounded-[32px]">

                    {{-- overlay --}}
                    <div class="w-full h-full absolute bg-black/40 rounded-[32px] "></div>
                    <div class="w-10/12 flex flex-col ml-28 z-10 ">
                        <span class="font-bold font-inter text-4xl text-white ">{{ $bannerItem->title }}</span>
                        <span class="font-inter text-xl text-white w-1/2 line-clamp-2">{{ $bannerItem->overview }}</span>
                        <a href="/movie/{{ $bannerItem->id }}"
                            class="w-fit bg-rault-500 text-white pl-2 pr-4 mt-5 py-2 font-inter text-sm flex flex-row rounded-full items-center hover:drop-shadow-lg duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                            </svg>
                            <span class="font-inter">Detail</span>
                        </a>
                    </div>
                </div>
            @endforeach
            {{-- prv button --}}
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center " onclick="moveSlide(-1)">
                <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
            </div>

            {{-- nxt button --}}
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center" onclick="moveSlide(+1)">
                <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200 -rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
            </div>

            {{-- Indikator --}}
            <div class="absolute bottom-0 w-full mb-3">
                <div class="w-full flex flex-row items-center justify-center">
                    @for ($i = 0; $i < count($banner); $i++)
                        <div class="w-3 h-3 rounded-full mx-1 cursor-pointer dot bg-white opacity-50 transition-opacity duration-300"
                            onclick="currentSlide({{ $i + 1 }})" data-index="{{ $i + 1 }}"></div>
                    @endfor
                </div>
            </div>
        </div>


        {{-- TOP 10 MOVIE SECTION --}}
        <div class="mt-10 border-2 border-gray-300 rounded-[32px] p-5 shadow-lg bg-white">
            <span class="ml-28 font-inter font-bold text-xl ">Top 10 Movies</span>
            <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
                @foreach ($topMovie as $movieItem)
                    @php
                        $original_date = $movieItem->release_date;
                        $timestamp = strtotime($original_date);
                        $movieYear = date('Y', $timestamp);

                        $movieID = $movieItem->id;
                        $movieTitle = $movieItem->title;
                        $movieRating = $movieItem->vote_average * 10;
                        $movieVoter = $movieItem->vote_count;
                        $movieImage = "{$imageBaseURL}/w500{$movieItem->poster_path}";
                    @endphp
                    <a href="/movie/{{ $movieID }}" class="group">
                        <div
                            class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                            <div class="overflow-hidden rounded-[32px]">
                                <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200"
                                    src="{{ $movieImage }}">
                            </div>
                            <span
                                class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $movieTitle }}</span>
                            <span class="font-inter text-sm mt-1">{{ $movieYear }}</span>
                            <div class="flex flex-row mt-1 items-center">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $movieRating }}%</span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24 ">
                                    <path fill-rule="evenodd"
                                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $movieVoter }}</span>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        
        {{-- POPULAR  SECTION --}}
        <div class="mt-8 border-2 border-gray-300 rounded-[32px] p-5 shadow-lg bg-white">
            <span class="ml-28 font-inter font-bold text-xl">Popular </span>
            <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
                @foreach ($airinganime as $animeAiringItem)
                    @php
                        $original_date = $animeAiringItem->release_date;
                        $timestamp = strtotime($original_date);
                        $animeAirYear = date('Y', $timestamp);

                        $animeAirID = $animeAiringItem->id;
                        $animeAirTitle = $animeAiringItem->title;
                        $animeAirRating = $animeAiringItem->vote_average * 10;
                        $animeAirVoter = $animeAiringItem->vote_count;
                        $animeAirImage = "{$imageBaseURL}/w500{$animeAiringItem->poster_path}";
                    @endphp
                    <a href="/movie/{{ $animeAirID }}" class="group">
                        <div
                            class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                            <div class="overflow-hidden rounded-[32px]">
                                <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200"
                                    src="{{ $animeAirImage }}">
                            </div>
                            <span
                                class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $animeAirTitle }}</span>
                            <span class="font-inter text-sm mt-1">{{ $animeAirYear }}</span>
                            <div class="flex flex-row mt-1 items-center">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $animeAirRating }}%</span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24 ">
                                    <path fill-rule="evenodd"
                                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $animeAirVoter }}</span>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- TV SHOW SECTION --}}
        <div class="mt-8 border-2 border-gray-300 rounded-[32px] p-5 shadow-lg bg-white">
            <span class="ml-28 font-inter font-bold text-xl">TV Shows</span>
            <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
                @foreach ($tvshow as $TvShowItem)
                    @php
                        $original_date = $TvShowItem->first_air_date;
                        $timestamp = strtotime($original_date);
                        $TvShowYear = date('Y', $timestamp);

                        $TvShowID = $TvShowItem->id;
                        $TvShowTitle = $TvShowItem->original_name;
                        $TvShowRating = $TvShowItem->vote_average * 10;
                        $TvShowVoter = $TvShowItem->vote_count;
                        $TvShowImage = "{$imageBaseURL}/w500{$TvShowItem->poster_path}";
                    @endphp
                    <a href="/tv/{{ $TvShowID }}" class="group">
                        <div
                            class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                            <div class="overflow-hidden rounded-[32px]">
                                <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200"
                                    src="{{ $TvShowImage }}">
                            </div>
                            <span
                                class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $TvShowTitle }}</span>
                            <span class="font-inter text-sm mt-1">{{ $TvShowYear }}</span>
                            <div class="flex flex-row mt-1 items-center">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $TvShowRating }}%</span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24 ">
                                    <path fill-rule="evenodd"
                                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $TvShowVoter }}</span>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- ANIME SECTION --}}
        <div class="mt-8 border-2 border-gray-300 rounded-[32px] p-5 shadow-lg bg-white mb-12">
            <span class="ml-28 font-inter font-bold text-xl">Anime</span>
            <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
                @foreach ($anime as $animeItem)
                    @php
                        $original_date = $animeItem->first_air_date;
                        $timestamp = strtotime($original_date);
                        $animeYear = date('Y', $timestamp);

                        $animeID = $animeItem->id;
                        $animeTitle = $animeItem->original_name;
                        $animeRating = $animeItem->vote_average * 10;
                        $animeVoter = $animeItem->vote_count;
                        $animeImage = "{$imageBaseURL}/w500{$animeItem->poster_path}";
                    @endphp
                    <a href="/tv/{{ $animeID }}" class="group">
                        <div
                            class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                            <div class="overflow-hidden rounded-[32px]">
                                <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200"
                                    src="{{ $animeImage }}">
                            </div>
                            <span
                                class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $animeTitle }}</span>
                            <span class="font-inter text-sm mt-1">{{ $animeYear }}</span>
                            <div class="flex flex-row mt-1 items-center">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $animeRating }}%</span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24 ">
                                    <path fill-rule="evenodd"
                                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $animeVoter }}</span>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- ANIME On Going SECTION
        <div class="mt-8 border-2 border-gray-300 rounded-[32px] p-5 shadow-lg bg-white mb-12">
            <span class="ml-28 font-inter font-bold text-xl">Anime</span>
            <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
                @foreach ($onGoingAnime as $sameItem)
                    @php
                        $status = $sameItem->status;
                        // $timestamp = strtotime($original_date);
                        // $animeYear = date('Y', $timestamp);

                        $animeID = $sameItem->animeId;
                        $sameTitle = $sameItem->title;
                        $sameRating = $sameItem->score;
                        $sameImage = $sameItem->poster;
                    @endphp
                    <a href="/tv/{{ $TvShowID }}" class="group">
                        <div
                            class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                            <div class="overflow-hidden rounded-[32px]">
                                <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200"
                                    src="{{ $animeImage }}">
                            </div>
                            <span
                                class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $animeTitle }}</span>
                            <span class="font-inter text-sm mt-1">{{ $animeYear }}</span>
                            <div class="flex flex-row mt-1 items-center">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $animeRating }}%</span>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                    viewBox="0 0 24 24 ">
                                    <path fill-rule="evenodd"
                                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-inter text-sm ml-1 mr-4">{{ $animeVoter }}</span>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div> --}}



        <script>
            let slideIndex = 1;
            let autoSlideInterval;

            showSlide(slideIndex);
            startAutoSlide();

            function showSlide(position) {
                let index;
                const slides = document.getElementsByClassName("slide");
                const dots = document.getElementsByClassName("dot");

                // Looping effect
                if (position > slides.length) {
                    slideIndex = 1;
                } else if (position < 1) {
                    slideIndex = slides.length;
                } else {
                    slideIndex = position;
                }

                // Hide all slides with smooth transition
                for (index = 0; index < slides.length; index++) {
                    slides[index].classList.add("opacity-0"); // Tambahkan opacity-0 dulu
                    slides[index].classList.remove("opacity-100"); // Hilangkan opacity-100

                    setTimeout(() => {
                        slides[index].classList.add("hidden"); // Setelah animasi selesai, baru `hidden`
                    }, 1500); // Delay sesuai durasi transisi
                }

                // Show active slide
                setTimeout(() => {
                    slides[slideIndex - 1].classList.remove("hidden"); // Hilangkan `hidden`
                    slides[slideIndex - 1].classList.add("opacity-100"); // Tambahkan `opacity-100`
                    slides[slideIndex - 1].classList.remove("opacity-0"); // Hilangkan `opacity-0`
                }, 10);

                updateIndicators();
            }

            // 🔥 **Fungsi untuk slide otomatis**
            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    showSlide(slideIndex + 1); // Maju ke slide berikutnya
                }, 10000); // ⏳ Ganti slide setiap 10 detik
            }

            // 🔥 **Hentikan auto-slide saat pengguna berpindah slide secara manual**
            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
                startAutoSlide(); // Mulai ulang setelah beberapa saat (opsional)
            }


            function moveSlide(moveStep) {
                showSlide(slideIndex += moveStep);
            }

            function updateIndicators() {
                const dots = document.querySelectorAll(".dot");

                dots.forEach((dot, index) => {
                    if (index + 1 === slideIndex) {
                        dot.classList.remove("opacity-50", "bg-white");
                        dot.classList.add("opacity-100", "bg-blue-500");
                    } else {
                        dot.classList.remove("opacity-100", "bg-blue-500");
                        dot.classList.add("opacity-50", "bg-white");
                    }
                });
            }

            // Panggil saat slide berubah
            setInterval(updateIndicators, 100);
        </script>
    @endsection
