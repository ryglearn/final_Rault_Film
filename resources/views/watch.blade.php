<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nonton | Rault Film</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-black transition-colors duration-300" id="bodyRoot">

    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl md:text-3xl font-bold">Nonton Film</h1>
            <button onclick="toggleCinema()" id="cinemaBtn" class="bg-gray-800 text-white px-3 py-1 rounded text-sm">
                CINEMA ON
            </button>
        </div>

        {{-- Video Player --}}
        @if($videoURL)
        <div class="aspect-video w-full mb-6 rounded-lg overflow-hidden shadow-lg border border-gray-400">
            <iframe 
                id="moviePlayer"
                src="{{ $videoURL }}" 
                class="w-full h-full"
                allowfullscreen
                frameborder="0"
                loading="lazy"
            ></iframe>
        </div>

        {{-- Mirror Buttons --}}
        <div class="flex flex-wrap justify-center gap-4">
            <button onclick="switchServer('{{ $videoURL }}')" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm text-white">
                Server 1 - PixelDrain (Default)
            </button>
            <button onclick="switchServer('https://drive.google.com/file/d/.../preview')" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded text-sm text-white">
                Server 2 - GDrive
            </button>
            <button onclick="switchServer('https://streamsb.com/e/xxxxxxx')" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded text-sm text-white">
                Server 3 - StreamSB
            </button>
        </div>
        @else
            <p class="text-red-500 text-center mt-8">Film tidak tersedia.</p>
        @endif
    </div>

    {{-- JS for Server Switch & Cinema Mode --}}
    <script>
        function switchServer(url) {
            document.getElementById('moviePlayer').src = url;
        }

        let isCinema = false;
        function toggleCinema() {
            const body = document.getElementById('bodyRoot');
            const btn = document.getElementById('cinemaBtn');

            isCinema = !isCinema;

            if (isCinema) {
                body.classList.remove('bg-white', 'text-black');
                body.classList.add('bg-black', 'text-white');
                btn.innerText = 'CINEMA OFF';
            } else {
                body.classList.remove('bg-black', 'text-white');
                body.classList.add('bg-white', 'text-black');
                btn.innerText = 'CINEMA ON';
            }
        }
    </script>
</body>
</html>
