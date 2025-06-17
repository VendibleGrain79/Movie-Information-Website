@extends ('layout.app')

@section('content')
<div class="movie-info bg-cover bg-no-repeat" style="background-image: url('https://image.tmdb.org/t/p/original/<?= $movie['backdrop_path'] ?>')">
    <div style="background-image: linear-gradient(to right, rgba(7.84%, 8.63%, 9.80%, 1.00) 150px, rgba(7.84%, 8.63%, 9.80%, 0.84) 30%)">
        <div class=" container mx-auto px-4 pt-16 flex flex-col md:flex-row">
            <div class=" flex-none">
                <img src="{{'https://image.tmdb.org/t/p/w500/' .$movie['poster_path']}}" class=" w-72" />
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold text-white">{{$movie['title']}}</h2>
                <div class=" flex items-center text-gray-400 text-sm">
                    <svg class="fill-current text-yellow-500 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    <span class="ml-1">{{round($movie['vote_average']* 10) . '%'}}</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, y') }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        @foreach ( $movie['genres'] as $genres )
                        {{ $genres['name'] }} @if (!$loop->last), @endif
                        @endforeach
                    </span>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold text-2xl text-white">Overview</h4>
                    <p class="text-gray-100">{{$movie['overview']}}</p>
                </div>
                <div class="mt-5">
                    <div class="flex mt-4">
                        @foreach($movie['credits']['crew'] as $crew)
                        @if ($loop->index < 5)
                            <div class="mr-12 ">
                            ​​​​​​​​​​​​​​​​​<div class="text-sm text-gray-100">{{$crew['job']}}</div>
                            <div class="text-white font-semibold ">{{$crew['name']}}</div>
                    </div>
                    @endif​​
                    @endforeach
                </div>
            </div>
            <div class="mt-12">
    @if (isset($movie['videos']['results'][1]))
        <a href="https://www.youtube.com/watch?v={{ $movie['videos']['results'][1]['key'] }}" target="_blank" class="flex items-center bg-transparent text-gray-50 rounded font-semibold focus:outline-none px-4 py-4 hover:text-yellow-400 transition ease-in-out duration-150">
            <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
            </svg>
            <span class="ml-2">Play Trailer</span>
        </a>
    @endif
</div>



        </div>
    </div>
</div>
</div>


<div class="movie-cast">
    <div class="container mx-auto px-4 py-16">
        <h2 class="capitalize text-white text-2xl font-semibold">Top Billed Cast</h2>
        <div class="grid lg:grid-cols-7 gap-8">
            @foreach ($movie['credits']['cast'] as $cast)
            @if ($loop->index < 7)
                <div class="mt-8">
                <a href="{{ route('actor.show', $cast['id']) }}">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $cast['profile_path'] }}" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg" />
                </a>
                <div class="mt-2">
                    <a href="{{ route('actor.show', $cast['id']) }}" class="text-md pt-4 text-white font-semibold hover:text-yellow-500">{{ $cast['name'] }}</a>
                    <div class="text-sm text-gray-400">
                        {{ $cast['character'] }}
                    </div>
                </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
</div>

<div class="movive-image">
    <div class="container mx-auto px-4 py-16">
        <h2 class="capitalize text-white text-2xl font-semibold">Images</h2>
        <div class="grid lg:grid-cols-4 gap-8">
            @foreach ($movie['images']['backdrops'] as $image)
            @if ($loop->index < 8)
                <div class="mt-8">
                <a href="#">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg" />
                </a>
        </div>
        @endif
        @endforeach
    </div>
</div>
</div>

<div class="movie-recommendation">
    <div class="container mx-auto px-4 py-16">
        <h2 class="capitalize text-white text-2xl font-semibold">Recommendations</h2>
        <div class="grid lg:grid-cols-7 gap-8">
            @foreach ($movieRecommendations as $movie)
            @if ($loop->index < 7)
                <div class="mt-8">
                <a href="{{ route('movie.show', $movie['id']) }}">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" class="hover:opacity-50 transition ease-in-out duration-150 rounded-lg" />
                </a>
                <div class="mt-2">
                    <a href="{{ route('movie.show', $movie['id']) }}" class="text-md pt-4 text-white font-semibold hover:text-yellow-500">
                        {{ $movie['title'] }}
                    </a>
                    <div class="flex items-center text-gray-400 text-sm">
                        <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, y') }}</span>
                    </div>
                </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
</div>


@endsection