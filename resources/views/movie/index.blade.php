@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 pt-8">
    <!-- Hero Section with Featured Movie (Optional) -->
    @if(isset($featuredMovie))
    <div class="relative h-96 mb-12 rounded-xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent z-10"></div>
        <img src="{{ 'https://image.tmdb.org/t/p/original' . $featuredMovie['backdrop_path'] }}" 
             class="w-full h-full object-cover" 
             alt="{{ $featuredMovie['title'] }}">
        <div class="absolute bottom-0 left-0 p-8 z-20 text-white">
            <h1 class="text-4xl font-bold mb-2">{{ $featuredMovie['title'] }}</h1>
            <p class="text-lg mb-4 max-w-2xl">{{ Str::limit($featuredMovie['overview'], 200) }}</p>
            <div class="flex items-center space-x-4">
                <span class="bg-yellow-500 text-black px-3 py-1 rounded-full font-semibold">
                    <i class="fas fa-star mr-1"></i>{{ number_format($featuredMovie['vote_average'], 1) }}
                </span>
                <span class="text-gray-300">{{ \Carbon\Carbon::parse($featuredMovie['release_date'])->format('M d, Y') }}</span>
                <a href="{{ route('movie.show', $featuredMovie['id']) }}" 
                   class="bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded-lg transition-colors">
                    <i class="fas fa-play mr-2"></i>View Details
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Filter Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 space-y-4 sm:space-y-0">
        <div class="flex flex-wrap items-center space-x-2 space-y-2 sm:space-y-0">
            <span class="text-white font-medium">Filter by:</span>
            <a href="{{ route('movie.index') }}" 
               class="px-4 py-2 rounded-full text-sm {{ !request('genre') ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                All
            </a>
            <a href="{{ route('movie.index', ['genre' => 'action']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'action' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Action
            </a>
            <a href="{{ route('movie.index', ['genre' => 'comedy']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'comedy' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Comedy
            </a>
            <a href="{{ route('movie.index', ['genre' => 'drama']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'drama' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Drama
            </a>
             <a href="{{ route('movie.index', ['genre' => 'horror']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'horror' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Horror
            </a>
            <a href="{{ route('movie.index', ['genre' => 'romance']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'romance' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Romance
            </a>
             <a href="{{ route('movie.index', ['genre' => 'sci-fi']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'sci-fi' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Sci-fi
            </a>
               <a href="{{ route('movie.index', ['genre' => 'thriller']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'thriller' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Thriller
            </a>
            <a href="{{ route('movie.index', ['genre' => 'adventure']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'adventure' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Adventure
            </a>
            <a href="{{ route('movie.index', ['genre' => 'animation']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'animation' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Animation
            </a>
            <a href="{{ route('movie.index', ['genre' => 'crime']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'crime' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Crime
            </a>
              <a href="{{ route('movie.index', ['genre' => 'documentary']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'documentary' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Documentary
            </a>
              <a href="{{ route('movie.index', ['genre' => 'family']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'family' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Family
            </a>
              <a href="{{ route('movie.index', ['genre' => 'fantasy']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'fantasy' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                Fantasy
            </a>
             <a href="{{ route('movie.index', ['genre' => 'history']) }}" 
               class="px-4 py-2 rounded-full text-sm {{ request('genre') == 'history' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                History
            </a>
        </div>
    </div>

    <!-- Popular Movies Section -->
    <div class="popular-movie pb-16">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-white text-2xl font-bold flex items-center">
                <i class="fas fa-fire text-orange-500 mr-3"></i>
                Popular Movies
            </h2>
           
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-4">
            @foreach($popularMovie as $movie)
                @if ($loop->index < 16)
                    <div class="group relative bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <a href="{{ route('movie.show', $movie['id']) }}" class="block">
                            <div class="relative overflow-hidden">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" 
                                     class="w-full h-64 sm:h-72 object-cover group-hover:scale-110 transition-transform duration-300" 
                                     alt="{{ $movie['title'] }}"
                                     loading="lazy" />
                                
                                <!-- Rating Badge -->
                                <div class="absolute top-2 left-2 bg-black/80 backdrop-blur-sm rounded-full w-10 h-10 flex items-center justify-center border-2 border-yellow-500">
                                    <span class="text-white font-bold text-xs">
                                        {{ round($movie['vote_average'] * 10) }}<small class="text-xs">%</small>
                                    </span>
                                </div>
                                
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-play text-white text-2xl mb-2"></i>
                                        <p class="text-white text-sm font-medium">View Details</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-3">
                                <h3 class="text-white font-semibold text-sm mb-1 line-clamp-2 group-hover:text-yellow-400 transition-colors">
                                    {{ $movie['title'] }}
                                </h3>
                                <div class="flex items-center justify-between text-gray-400 text-xs">
                                    <span>
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-star text-yellow-500 mr-1"></i>
                                        {{ number_format($movie['vote_average'], 1) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Upcoming Movies Section -->
    <div class="upcoming-movie pb-16">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-white text-2xl font-bold flex items-center">
                <i class="fas fa-clock text-blue-500 mr-3"></i>
                Upcoming Movies
            </h2>
            
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-4">
            @foreach($upcomingMovie as $movie)
                @if ($loop->index < 16)
                    <div class="group relative bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <a href="{{ route('movie.show', $movie['id']) }}" class="block">
                            <div class="relative overflow-hidden">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" 
                                     class="w-full h-64 sm:h-72 object-cover group-hover:scale-110 transition-transform duration-300" 
                                     alt="{{ $movie['title'] }}"
                                     loading="lazy" />
                                
                                <!-- Rating Badge -->
                                <div class="absolute top-2 left-2 bg-black/80 backdrop-blur-sm rounded-full w-10 h-10 flex items-center justify-center border-2 border-blue-500">
                                    <span class="text-white font-bold text-xs">
                                        {{ round($movie['vote_average'] * 10) }}<small class="text-xs">%</small>
                                    </span>
                                </div>
                                
                                <!-- Coming Soon Badge -->
                                <div class="absolute top-2 right-2 bg-blue-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    Coming Soon
                                </div>
                                
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-eye text-white text-2xl mb-2"></i>
                                        <p class="text-white text-sm font-medium">View Details</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-3">
                                <h3 class="text-white font-semibold text-sm mb-1 line-clamp-2 group-hover:text-blue-400 transition-colors">
                                    {{ $movie['title'] }}
                                </h3>
                                <div class="flex items-center justify-between text-gray-400 text-xs">
                                    <span>
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}
                                    </span>
                                    @if($movie['vote_average'] > 0)
                                    <span class="flex items-center">
                                        <i class="fas fa-star text-yellow-500 mr-1"></i>
                                        {{ number_format($movie['vote_average'], 1) }}
                                    </span>
                                    @else
                                    <span class="text-gray-500 text-xs">Not Rated</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Top Rated Movies Section (Optional - add if you have the data) -->
    @if(isset($topRatedMovie))
    <div class="top-rated-movie pb-16">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-white text-2xl font-bold flex items-center">
                <i class="fas fa-trophy text-yellow-500 mr-3"></i>
                Top Rated Movies
            </h2>
            
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-4">
            @foreach($topRatedMovie as $movie)
                @if ($loop->index < 16)
                    <div class="group relative bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <a href="{{ route('movie.show', $movie['id']) }}" class="block">
                            <div class="relative overflow-hidden">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" 
                                     class="w-full h-64 sm:h-72 object-cover group-hover:scale-110 transition-transform duration-300" 
                                     alt="{{ $movie['title'] }}"
                                     loading="lazy" />
                                
                                <!-- Rating Badge -->
                                <div class="absolute top-2 left-2 bg-black/80 backdrop-blur-sm rounded-full w-10 h-10 flex items-center justify-center border-2 border-yellow-500">
                                    <span class="text-white font-bold text-xs">
                                        {{ round($movie['vote_average'] * 10) }}<small class="text-xs">%</small>
                                    </span>
                                </div>
                                
                                <!-- Top Rated Badge -->
                                <div class="absolute top-2 right-2 bg-yellow-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-crown mr-1"></i>Top Rated
                                </div>
                                
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-play text-white text-2xl mb-2"></i>
                                        <p class="text-white text-sm font-medium">View Details</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-3">
                                <h3 class="text-white font-semibold text-sm mb-1 line-clamp-2 group-hover:text-yellow-400 transition-colors">
                                    {{ $movie['title'] }}
                                </h3>
                                <div class="flex items-center justify-between text-gray-400 text-xs">
                                    <span>
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-star text-yellow-500 mr-1"></i>
                                        {{ number_format($movie['vote_average'], 1) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- Pagination (if applicable) -->
    @if(isset($movies) && method_exists($movies, 'links'))
    <div class="flex justify-center mt-12">
        {{ $movies->links() }}
    </div>
    @endif
</div>

<!-- Custom CSS for line clamping -->
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection