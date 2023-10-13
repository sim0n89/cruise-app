<?php

namespace App\Http\Controllers;

use App\Models\Cabin_categories;
use Illuminate\Http\Request;

class CabinCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Cabin_categories::orderBy('ordering', "ASC")->with('ships')->get();
        return response($categories->jsonSerialize(), 200);
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
     * Display the specified resource.
     */
    public function show(Cabin_categories $cabin_categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabin_categories $cabin_categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabin_categories $cabin_categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabin_categories $cabin_categories)
    {
        //
    }
}
