<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

class BreweryController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all breweries from the API
        $breweries = Http::get(User::URL_API)->json();

        // Manually paginate the data
        $currentPage = LengthAwarePaginator::resolveCurrentPage(); // Get the current page from the request
        $perPage = 10; // Number of items per page
        $currentPageItems = array_slice($breweries, ($currentPage - 1) * $perPage, $perPage);

        // Create a LengthAwarePaginator instance
        $paginatedBreweries = new LengthAwarePaginator(
            $currentPageItems,
            count($breweries),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Pass paginated data to the view
        return view('welcome', data: ['breweries' => $paginatedBreweries]);
    }
}
