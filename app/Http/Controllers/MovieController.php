<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    // Store your TMDB token as a constant for better maintainability
    private const TMDB_TOKEN = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyNWZhNDA3ZGRmMGNkMjA4OTBjYjUyNjIwZDI0NGUxNyIsIm5iZiI6MTc0NzMyNzg4OS4yMTgsInN1YiI6IjY4MjYxYjkxMjMyYTA2NmJiMTc2N2VjNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.h4RV4RmCaWJa58PAlGgNiUnylDk0O7GsZOVHTTzDQb4';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Handle genre filtering
        $genre = $request->get('genre');
        $sort = $request->get('sort', 'popularity');
        $category = $request->get('category');

        // If specific category is requested, redirect to appropriate method
        if ($category) {
            switch ($category) {
                case 'popular':
                    return $this->getPopularMovies($request);
                case 'upcoming':
                    return $this->getUpcomingMovies($request);
                case 'top_rated':
                    return $this->getTopRatedMovies($request);
            }
        }

        // Get popular movies
        $popularMovieUrl = 'https://api.themoviedb.org/3/movie/popular';
        if ($genre) {
            $genreId = $this->getGenreId($genre);
            if ($genreId) {
                $popularMovieUrl = 'https://api.themoviedb.org/3/discover/movie?with_genres=' . $genreId . '&sort_by=popularity.desc';
            }
        }

        $popularMovie = Http::withToken(self::TMDB_TOKEN)
            ->get($popularMovieUrl)
            ->json()['results'] ?? [];

        // Get upcoming movies
        $upcomingMovieUrl = 'https://api.themoviedb.org/3/movie/upcoming';
        if ($genre) {
            $genreId = $this->getGenreId($genre);
            if ($genreId) {
                $upcomingMovieUrl = 'https://api.themoviedb.org/3/discover/movie?with_genres=' . $genreId . '&primary_release_date.gte=' . now()->format('Y-m-d');
            }
        }

        $upcomingMovie = Http::withToken(self::TMDB_TOKEN)
            ->get($upcomingMovieUrl)
            ->json()['results'] ?? [];

        // Get top rated movies (optional)
        $topRatedMovie = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/movie/top_rated')
            ->json()['results'] ?? [];

        // Get trending movie for hero section (optional)
        $featuredMovie = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/trending/movie/week')
            ->json()['results'][0] ?? null;

        return view('movie.index', [
            'popularMovie' => $popularMovie,
            'upcomingMovie' => $upcomingMovie,
            'topRatedMovie' => $topRatedMovie,
            'featuredMovie' => $featuredMovie,
            'currentGenre' => $genre,
            'currentSort' => $sort
        ]);
    }

    /**
     * Search for movies
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $page = $request->get('page', 1);

        if (empty($query)) {
            return redirect()->route('movie.index')->with('error', 'Please enter a search term.');
        }

        // Search movies using TMDB API
        $response = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/search/movie', [
                'query' => $query,
                'page' => $page,
                'include_adult' => false
            ]);

        $searchResults = $response->json();
        $movies = $searchResults['results'] ?? [];
        $totalResults = $searchResults['total_results'] ?? 0;
        $totalPages = $searchResults['total_pages'] ?? 1;

        // Get popular movies as suggestions if no results
        $popularMovies = [];
        if (empty($movies)) {
            $popularMovies = Http::withToken(self::TMDB_TOKEN)
                ->get('https://api.themoviedb.org/3/movie/popular')
                ->json()['results'] ?? [];
        }

        return view('movie.search', [
            'movies' => $movies,
            'query' => $query,
            'totalResults' => $totalResults,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'popularMovies' => $popularMovies
        ]);
    }

    /**
     * Get movie categories/genres
     */
    public function categories()
    {
        // Get all genres from TMDB
        $genres = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'] ?? [];

        // Get popular movies for each major genre
        $genreMovies = [];
        $popularGenres = [28, 35, 18, 27, 10749, 878, 53, 12]; // Action, Comedy, Drama, Horror, Romance, Sci-Fi, Thriller, Adventure

        foreach ($popularGenres as $genreId) {
            $genreInfo = collect($genres)->firstWhere('id', $genreId);
            if ($genreInfo) {
                $movies = Http::withToken(self::TMDB_TOKEN)
                    ->get('https://api.themoviedb.org/3/discover/movie', [
                        'with_genres' => $genreId,
                        'sort_by' => 'popularity.desc',
                        'page' => 1
                    ])
                    ->json()['results'] ?? [];

                $genreMovies[] = [
                    'genre' => $genreInfo,
                    'movies' => array_slice($movies, 0, 8) // Limit to 8 movies per genre
                ];
            }
        }

        return view('movie.categories', [
            'genres' => $genres,
            'genreMovies' => $genreMovies
        ]);
    }

    /**
     * AJAX search for live search results
     */
    public function searchApi(Request $request)
    {
        $query = $request->get('query');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $response = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/search/movie', [
                'query' => $query,
                'page' => 1,
                'include_adult' => false
            ]);

        $movies = $response->json()['results'] ?? [];

        // Return only first 10 results for dropdown
        return response()->json(array_slice($movies, 0, 10));
    }

    /**
     * Get popular movies page
     */
    public function getPopularMovies(Request $request)
    {
        $page = $request->get('page', 1);
        $genre = $request->get('genre');

        $url = 'https://api.themoviedb.org/3/movie/popular';
        $params = ['page' => $page];

        if ($genre) {
            $genreId = $this->getGenreId($genre);
            if ($genreId) {
                $url = 'https://api.themoviedb.org/3/discover/movie';
                $params = array_merge($params, [
                    'with_genres' => $genreId,
                    'sort_by' => 'popularity.desc'
                ]);
            }
        }

        $response = Http::withToken(self::TMDB_TOKEN)->get($url, $params);
        $data = $response->json();

        return view('movie.list', [
            'movies' => $data['results'] ?? [],
            'currentPage' => $page,
            'totalPages' => $data['total_pages'] ?? 1,
            'totalResults' => $data['total_results'] ?? 0,
            'title' => 'Popular Movies',
            'currentGenre' => $genre
        ]);
    }

    /**
     * Get upcoming movies page
     */
    public function getUpcomingMovies(Request $request)
    {
        $page = $request->get('page', 1);

        $response = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/movie/upcoming', [
                'page' => $page
            ]);

        $data = $response->json();

        return view('movie.list', [
            'movies' => $data['results'] ?? [],
            'currentPage' => $page,
            'totalPages' => $data['total_pages'] ?? 1,
            'totalResults' => $data['total_results'] ?? 0,
            'title' => 'Upcoming Movies'
        ]);
    }

    /**
     * Get top rated movies page
     */
    public function getTopRatedMovies(Request $request)
    {
        $page = $request->get('page', 1);

        $response = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/movie/top_rated', [
                'page' => $page
            ]);

        $data = $response->json();

        return view('movie.list', [
            'movies' => $data['results'] ?? [],
            'currentPage' => $page,
            'totalPages' => $data['total_pages'] ?? 1,
            'totalResults' => $data['total_results'] ?? 0,
            'title' => 'Top Rated Movies'
        ]);
    }

    /**
     * Helper method to get genre ID from genre name
     */
    private function getGenreId($genreName)
    {
        $genreMap = [
            'action' => 28,
            'adventure' => 12,
            'animation' => 16,
            'comedy' => 35,
            'crime' => 80,
            'documentary' => 99,
            'drama' => 18,
            'family' => 10751,
            'fantasy' => 14,
            'history' => 36,
            'horror' => 27,
            'music' => 10402,
            'mystery' => 9648,
            'romance' => 10749,
            'sci-fi' => 878,
            'science-fiction' => 878,
            'tv-movie' => 10770,
            'thriller' => 53,
            'war' => 10752,
            'western' => 37
        ];

        return $genreMap[strtolower($genreName)] ?? null;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        if (!$movie || isset($movie['success']) && !$movie['success']) {
            abort(404, 'Movie not found');
        }

        $movieRecommendations = Http::withToken(self::TMDB_TOKEN)
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/recommendations')
            ->json()['results'] ?? [];

        // Get similar movies if recommendations are empty
        if (empty($movieRecommendations)) {
            $movieRecommendations = Http::withToken(self::TMDB_TOKEN)
                ->get('https://api.themoviedb.org/3/movie/' . $id . '/similar')
                ->json()['results'] ?? [];
        }

        return view('movie.show', [
            'movie' => $movie,
            'movieRecommendations' => $movieRecommendations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}