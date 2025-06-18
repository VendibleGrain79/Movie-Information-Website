<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Movie Information Website</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
       @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>

    <body class="bg-gray-800 font-sans">
        <nav class="bg-gray-900 border-b border-gray-700 sticky top-0 z-50">
            <div class="container mx-auto px-2">
                <div class="relative flex h-16 items-center justify-between">
                    <!-- Mobile menu button -->
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <button type="button" id="mobile-menu-button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <svg class="block size-6" id="menu-closed-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <svg class="hidden size-6" id="menu-open-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Logo and Navigation -->
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex shrink-0 items-center">
                            <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Movie Info">
                            <span class="ml-2 text-white font-semibold text-lg hidden sm:block">Movie Info Web</span>
                        </div>
                        
                        <!-- Desktop Navigation -->
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <a href="{{ route('movie.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Movies</a>
                                
                                <!-- Categories Dropdown -->
                                <div class="relative group">
                                    <button class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors flex items-center">
                                        Categories
                                        <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                    </button>
                                    <div class="absolute left-0 mt-2 w-48 bg-gray-800 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                        <div class="py-2">
                                            <a href="{{ route('movie.index', ['genre' => 'action']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Action</a>
                                            <a href="{{ route('movie.index', ['genre' => 'comedy']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Comedy</a>
                                            <a href="{{ route('movie.index', ['genre' => 'drama']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Drama</a>
                                            <a href="{{ route('movie.index', ['genre' => 'horror']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Horror</a>
                                            <a href="{{ route('movie.index', ['genre' => 'romance']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Romance</a>
                                            <a href="{{ route('movie.index', ['genre' => 'sci-fi']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Sci-Fi</a>
                                            <a href="{{ route('movie.index', ['genre' => 'thriller']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Thriller</a>
                                            <a href="{{ route('movie.index', ['genre' => 'adventure ']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Adventure</a>
                                            <a href="{{ route('movie.index', ['genre' => 'animation']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Animation</a>
                                            <a href="{{ route('movie.index', ['genre' => 'crime']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Crime</a>
                                            <a href="{{ route('movie.index', ['genre' => 'documentary']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Documentary</a>
                                            <a href="{{ route('movie.index', ['genre' => 'family']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Family</a>
                                            <a href="{{ route('movie.index', ['genre' => 'fantasy']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Fantasy</a>
                                            <a href="{{ route('movie.index', ['genre' => 'history']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">History</a>
                                            <a href="{{ route('movie.index', ['genre']) }}" class="block px-4 py-2 text-sm text-indigo-400 hover:bg-gray-700 hover:text-indigo-300 border-t border-gray-700">View All</a>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('actor.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Actors</a>
                                
                                
                            </div>
                        </div>
                    </div>

                    <!-- Search and Profile -->
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                      <!-- Search Bar -->
<div class="relative mr-4">
    <div class="relative">
        <input type="text" 
               name="query" 
               id="search-input"
               placeholder="Search movies..." 
               value="{{ request('query') }}"
               class="w-64 pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
               autocomplete="off">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
        </div>
    </div>
    
    <!-- Search Results Dropdown -->
    <div id="search-results" class="absolute top-full left-0 right-0 mt-1 bg-gray-800 rounded-lg shadow-lg border border-gray-600 hidden z-50 max-h-96 overflow-y-auto">
        <div class="p-3 text-gray-400">Start typing to search movies...</div>
    </div>
</div>

                        <!-- Profile dropdown -->
                        <div class="relative">
                            <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="size-8 rounded-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxVuqYscuFT64w9XmWjrtXuA8YLMQCBC2ksg&s" alt="Profile">
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="sm:hidden hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pt-2 pb-3 border-t border-gray-700">
                    <a href="{{ route('movie.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Movies</a>
                    
                    <!-- Mobile Categories -->
                    <div class="block">
                        <button id="mobile-categories-button" class="w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white flex justify-between items-center">
                            Categories
                            <i class="fas fa-chevron-down text-xs" id="mobile-categories-icon"></i>
                        </button>
                        <div id="mobile-categories-menu" class="hidden pl-4 space-y-1">
                           <a href="{{ route('movie.index', ['genre' => 'action']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Action</a>
                                            <a href="{{ route('movie.index', ['genre' => 'comedy']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Comedy</a>
                                            <a href="{{ route('movie.index', ['genre' => 'drama']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Drama</a>
                                            <a href="{{ route('movie.index', ['genre' => 'horror']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Horror</a>
                                            <a href="{{ route('movie.index', ['genre' => 'romance']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Romance</a>
                                            <a href="{{ route('movie.index', ['genre' => 'sci-fi']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Sci-Fi</a>
                                            <a href="{{ route('movie.index', ['genre' => 'thriller']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Thriller</a>
                                            <a href="{{ route('movie.index', ['genre' => 'adventure ']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Adventure</a>
                                            <a href="{{ route('movie.index', ['genre' => 'animation']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Animation</a>
                                            <a href="{{ route('movie.index', ['genre' => 'crime']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Crime</a>
                                            <a href="{{ route('movie.index', ['genre' => 'documentary']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Documentary</a>
                                            <a href="{{ route('movie.index', ['genre' => 'family']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Family</a>
                                            <a href="{{ route('movie.index', ['genre' => 'fantasy']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Fantasy</a>
                                            <a href="{{ route('movie.index', ['genre' => 'history']) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">History</a>
                                            <a href="{{ route('movie.index', ['genre']) }}" class="block px-4 py-2 text-sm text-indigo-400 hover:bg-gray-700 hover:text-indigo-300 border-t border-gray-700">View All</a>
                        </div>
                    </div>
                    
                    <a href="{{ route('actor.index') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Actors</a>
                </div>

             
        </nav>

        @yield('content')

        <!-- JavaScript for interactive features -->
    <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        const menuClosedIcon = document.getElementById('menu-closed-icon');
        const menuOpenIcon = document.getElementById('menu-open-icon');
        
        mobileMenu.classList.toggle('hidden');
        menuClosedIcon.classList.toggle('hidden');
        menuOpenIcon.classList.toggle('hidden');
    });

    // Mobile categories toggle
    document.getElementById('mobile-categories-button').addEventListener('click', function() {
        const categoriesMenu = document.getElementById('mobile-categories-menu');
        const categoriesIcon = document.getElementById('mobile-categories-icon');
        
        categoriesMenu.classList.toggle('hidden');
        categoriesIcon.classList.toggle('fa-chevron-down');
        categoriesIcon.classList.toggle('fa-chevron-up');
    });

    // Live search functionality
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            searchResults.innerHTML = '<div class="p-3 text-gray-400">Type at least 2 characters</div>';
            searchResults.classList.remove('hidden');
            return;
        }
        
        searchTimeout = setTimeout(() => {
            fetchSearchResults(query);
        }, 300);
    });

    // Handle click outside to close dropdown
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative.mr-4')) {
            searchResults.classList.add('hidden');
        }
    });

    // Handle keyboard navigation
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            const firstResult = searchResults.querySelector('a');
            if (firstResult) firstResult.focus();
        }
    });

// Update the fetchSearchResults function in your JavaScript
function fetchSearchResults(query) {
    fetch(`/search-movies?query=${encodeURIComponent(query)}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        displaySearchResults(data);
    })
    .catch(error => {
        console.error('Error fetching search results:', error);
        searchResults.innerHTML = '<div class="p-3 text-red-400">Error loading results</div>';
        searchResults.classList.remove('hidden');
    });
}

// Update the displaySearchResults function
function displaySearchResults(results) {
    if (!results || results.length === 0) {
        searchResults.innerHTML = '<div class="p-3 text-gray-400">No results found</div>';
    } else {
        const html = results.map(movie => `
            <a href="/movies/${movie.id}" class="flex items-center p-3 hover:bg-gray-700 border-b border-gray-600 last:border-b-0 transition-colors">
                <img src="${movie.poster_path ? 'https://image.tmdb.org/t/p/w92' + movie.poster_path : 'https://via.placeholder.com/92x138?text=No+Poster'}" 
                     alt="${movie.title}" 
                     class="w-12 h-16 object-cover rounded mr-3">
                <div>
                    <div class="text-white font-medium">${movie.title}</div>
                    <div class="text-gray-400 text-sm">${movie.release_date ? movie.release_date.substring(0, 4) : 'N/A'}</div>
                </div>
            </a>
        `).join('');
        searchResults.innerHTML = html;
    }
    
    searchResults.classList.remove('hidden');
}
</script>
    </body>
</html>
