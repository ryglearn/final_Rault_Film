<header class="w-full bg-white h-[96px] drop-shadow-lg flex flex-row items-center p-5 mb-15">
    <div class="w-1/3 pl-5">
        <a href="{{ url('movies') }}"
            class="uppercase text-base mx-5 text-black hover:text-rault-500 duration-200 font-inter text-header">
            Movies
        </a>
        <a href="{{ url('tv-show') }}"
            class="uppercase text-base mx-5 text-black hover:text-rault-500 duration-200 font-inter text-header">
            TV Show
        </a>
    </div>

    <div class="w-1/3 flex items-center justify-center">
        <a href="/"
            class="font-bold text-5xl font-quicksand text-black hover:text-rault-500 duration-200 text-header">
            RAULT FILM
        </a>
    </div>

    <div class="w-1/3 flex flex-row justify-end pr-10 items-center">
        <a href="{{ url('search') }}" class="group mr-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                    d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                    clip-rule="evenodd" class="fill-black group-hover:fill-rault-500 duration-200" />
            </svg>
        </a>

        <!-- Dropdown Menu -->
        <div class="relative">
            <button onclick="toggleDropdown()" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M12 2.25a9.75 9.75 0 1 1 0 19.5 9.75 9.75 0 0 1 0-19.5ZM8.25 10.5a3.75 3.75 0 1 0 7.5 0 3.75 3.75 0 0 0-7.5 0ZM3 10.5a9 9 0 1 1 18 0 9 9 0 0 1-18 0Z"
                        clip-rule="evenodd" class="fill-black group-hover:fill-rault-500 duration-200" />
                </svg>
            </button>

            <div id="dropdownMenu"
                class="hidden absolute right-0 top-full mt-2 w-40 bg-white rounded-lg shadow-lg z-50">
                @auth
                    <a href="{{ url('profile') }}" class="block px-4 py-2 text-sm font-bold text-black hover:bg-gray-100">
                        {{ auth()->user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-black hover:bg-gray-100">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-black hover:bg-gray-100">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    function toggleDropdown() {
        let menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("hidden");
    }
</script>
