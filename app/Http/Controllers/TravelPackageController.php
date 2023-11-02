<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\TravelPackageRequest;
use RealRashid\SweetAlert\Facades\Alert;


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
    public function store(TravelPackageRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($request->title);

        TravelPackage::create($data);

        Alert::toast()->success('Success!', 'Travel package has been created!')
            ->position('top-end')->autoClose(3000);
        return redirect()->route('travel-package.index');
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
        return view('pages.admin.travel-packages.edit', [
            'package' => $travelPackage
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TravelPackageRequest $request, TravelPackage $travelPackage)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($request->title);

        $travelPackage->update($data);

        Alert::toast()->success('Success!', 'Travel package has been updated!')
            ->position('top-end')->autoClose(3000);
        return redirect()->route('travel-package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelPackage $travelPackage)
    {
        $travelPackage->delete();
        return redirect()->route('travel-package.index');
    }
}
