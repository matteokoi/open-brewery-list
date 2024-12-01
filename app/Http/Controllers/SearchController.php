<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $queryUnfiltered = $request->input('query');
        $query = User::secureInput($queryUnfiltered);
        $response = Http::get(User::URL_API, [
            'by_name' => $query,
        ]);

        if ($response->successful()) {
            $breweries = $response->json();
        } else {
            $breweries = [];
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageItems = array_slice($breweries, ($currentPage - 1) * $perPage, $perPage);

        $paginatedBreweries = new LengthAwarePaginator(
            $currentPageItems,
            count($breweries),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('welcome', data: ['breweries' => $paginatedBreweries]);
    }
}
