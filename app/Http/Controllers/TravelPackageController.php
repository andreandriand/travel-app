<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\Http\Request;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = TravelPackage::all();
        return view('pages.admin.travel-packages.index', [
            'packages' => $packages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.travel-packages.create');
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
    public function show(TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelPackage $travelPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelPackage $travelPackage)
    {
        //
    }
}
