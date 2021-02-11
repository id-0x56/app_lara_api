<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HouseController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $houses = House::query();

        if ($request->has('name')) {
            $houses->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('price_start') || $request->has('price_end')) {
            $price_start = $request->has('price_start') ? $request->input('price_start') : House::min('price');
            $price_end = $request->has('price_end') ? $request->input('price_end') : House::max('price');

            $houses->whereBetween('price', [$price_start, $price_end]);
        }

        if ($request->has('bedroom')) {
            $houses->where('bedroom', $request->input('bedroom'));
        }

        if ($request->has('bathroom')) {
            $houses->where('bathroom', $request->input('bathroom'));
        }

        if ($request->has('storey')) {
            $houses->where('storey', $request->input('storey'));
        }

        if ($request->has('garage')) {
            $houses->where('garage', $request->input('garage'));
        }

//        dump($houses->get());

        return response()->json([
            'houses' => $houses->get()->jsonSerialize(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('House/Index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
