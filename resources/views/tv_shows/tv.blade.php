@extends('layouts.app')
@section('title', 'Rault Film | tv')
@section('content')
    {{-- SORT SECTION --}}
    <div class="ml-28 mt-4 flex flex-row items-center">
        <span class="font-inter font-bold text-xl">Sort By :</span>
        <div class="relative ml-2">
            <select
                class="block appearance-none bg-white dark:bg-gray-800 dark:text-white 
            drop-shadow-[0_0px_4px_rgba(0,0,0,0.25)] text-black font-inter py-2 pl-4 pr-8 
            rounded-lg leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-700 relative"
                onchange="changeSort(this)">
                <option value="popularity.desc">Popularity (Descending)</option>
                <option value="popularity.asc">Popularity (Ascending)</option>
                <option value="vote_average.desc">Top Rated (Descending)</option>
                <option value="vote_average.asc">Top Rated (Ascending)</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 9-7 7-7-7" />
                </svg>
            </div>
        </div>
    </div>
    {{-- CONTENT SECTION --}}
    <div class="auto pl-28 pr10 pt-6 pb-10 grid grid-cols-3 lg:grid-cols-5 gap-5" id="dataWrapper">
        @foreach ($tvShows as $tvItem)
            @php
                $original_date = $tvItem->first_air_date;
                $timestamp = strtotime($original_date);

                $tvYear = date('Y', $timestamp);
                $tvID = $tvItem->id;
                $tvTitle = $tvItem->original_name;
                $tvRating = $tvItem->vote_average * 10;
                $tvImage = "{$imageBaseURL}/w500{$tvItem->poster_path}";
                $tvVoter = $tvItem->vote_count;
            @endphp
            <a href="tv/{{ $tvID }}" class="group">
                <div
                    class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                    <div class="overflow-hidden rounded-[32px]">
                        <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200"
                            src="{{ $tvImage }}">
                    </div>
                    <span
                        class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $tvTitle }}</span>
                    <span class="font-inter text-sm mt-1">{{ $tvYear }}</span>
                    <div class="flex flex-row mt-1 items-center">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-inter text-sm ml-1 mr-4">{{ $tvRating }}%</span>
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                            viewBox="0 0 24 24 ">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-inter text-sm ml-1 mr-4">{{ $tvVoter }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- DATA LOADER --}}
    <div class="w-full pl-28 pr-10 flex justify-center mb-5" id="autoLoad">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="54"
            height="54" style="shape-rendering: auto; display: block; background: rgb(255, 255, 255);"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g>
                <path style="transform:scale(0.8);transform-origin:50px 50px" stroke-linecap="butt"
                    d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z"
                    stroke-dasharray="42.76482137044271 42.76482137044271" stroke-width="8" stroke="#121212" fill="none">
                    <animate values="0;256.58892822265625" keyTimes="0;1" dur="1s" repeatCount="indefinite"
                        attributeName="stroke-dashoffset"></animate>
                </path>
                <g></g>
            </g><!-- [ldio] generated by https://loading.io -->
        </svg>
    </div>

    {{-- ERROR NOTIFICATION --}}
    <div id="notification"
        class="min-w-[250px] p-4 bg-red-700 text-white text-center rounded-lg fixed z-index-10 top-0 right-0 mr-10 mt-5 drop-shadow-lg">
        <span id="notificationMessage"></span>
    </div>

    {{-- LOAD MORE SECTION --}}
    <div class="w-full pl-28 pr-10" id="loadMore">
        <button class="w-full mb-10 bg-rault-500 text-white p-4 font-inter rounded-xl  font-bold uppercase drop-shadow-lg"
            onclick="loadMore()">
            Load More
        </button>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        let baseURL = "<?php echo $baseURL; ?>";
        let imageBaseURL = "<?php echo $imageBaseURL; ?>";
        let apiKey = "<?php echo $apiKey; ?>";
        let sortBy = "<?php echo $sortBy; ?>";
        let page = "<?php echo $page; ?>";
        let minimalVoter = "<?php echo $minimalVoter; ?>";

        // Hide Loader 
        $("#autoLoad").hide();
        // Hide Notification 
        $("#notification").hide();

        // Loadmore Function
        function loadMore() {
            $.ajax({
                    url: `${baseURL}/discover/tv?page=${++page}&sort_by=${sortBy}&api_key=${apiKey}&vote_count.gte=${minimalVoter}`,
                    type: "get",
                    beforeSend: function() {
                        $("#autoLoad").show();
                    }
                })
                .done(function(response) {
                    $("#autoLoad").hide();

                    // Get Data
                    if (response.results) {
                        let htmlData = [];
                        response.results.forEach(item => {
                            let original_date = item.release_date;
                            let date = new Date(original_date);
                            let tvYear = date.getFullYear();
                            let tvID = item.id;
                            let tvTitle = item.title;
                            let tvImage = `${imageBaseURL}/w500${item.poster_path}`;
                            let tvRating = Math.floor(item.vote_average * 10);
                            let tvVoter = item.vote_count;

                            htmlData.push(`<a href="tv/${tvID}" class="group">
                    <div class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] 
                        group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                        <div class="overflow-hidden rounded-[32px]">
                            <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200"
                                src="${tvImage}">
                        </div>
                        <span class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">${tvTitle}</span>
                        <span class="font-inter text-sm mt-1">${tvYear}</span>
                        <div class="flex flex-row mt-1 items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63Z" 
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-inter text-sm ml-1 mr-4">${tvRating}%</span>
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#38B6FF"
                                viewBox="0 0 24 24 ">
                                <path fill-rule="evenodd"
                                    d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" 
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-inter text-sm ml-1 mr-4">${tvVoter}</span>
                        </div>
                    </div>
                </a>`);
                        });

                        $("#dataWrapper").append(htmlData.join(""));

                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    $("#autoLoad").hide();
                    // Show Notifications
                    $("#notificationMessage").text("Error Boskuhh!");
                    $("#notification").show();
                    // Set Timeout
                    setTimeout(function() {
                        $("#notification").hide();
                    }, 3000);
                });
        }

        // Short by Function
        function changeSort(component) {
            console.log('component:', component);
            console.log('component_value:', component.value);
            if (component.value) {
                // set new value
                sortBy = component.value;
                // clear
                $("#dataWrapper").html("");
                // reser page
                page = 0;

                // get data
                loadMore();
            }
        }
    </script>
@endsection
