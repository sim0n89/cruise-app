<?php

namespace App\Http\Controllers;

use App\Models\Ships;
use App\Models\Ships_gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

class ShipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ships = Ships::orderBy('ordering', "ASC")->with('gallery')->with('category')->get();
        return response($ships->jsonSerialize(), 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'spec' => 'required',
            'ordering' => "required|digits_between:1,4",
        ]);
        $ship = new Ships();
        $ship->title = $request->title;
        $ship->description = $request->description;
        $ship->spec = json_encode($request->spec);
        $ship->save();

        if (!empty($request->gallery)) {
            foreach ($request->gallery as $image) {
                $ship_gallery = new Ships_gallery(
                    array(
                        'ship_id' => $ship->id,
                        'title' => $image["title"],
                        'url' => asset($image["file"]),
                        'ordering' => $image["ordering"]
                    )
                );
                $ship -> gallery()->save($ship_gallery);
            }
        }
        return $ship;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ship = Ships::where('id', $id)->with('gallery')->first();
        return response($ship->jsonSerialize(), 200);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ships $ships)
    {
        $ship = Ships::findOrFail($ships);
        $ship->update($request->all());
        return $ship;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ships = Ships::find($id);
        $ships->delete();
        return $id;
    }
}
