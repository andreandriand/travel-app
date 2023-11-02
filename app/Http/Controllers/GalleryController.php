<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.gallery.index', [
            'galleries' => Gallery::with('travel_package')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = TravelPackage::all();
        return view('pages.admin.gallery.create', [
            'packages' => $packages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->file('image')->store(
            'assets/gallery',
            'public'
        );

        Gallery::create($data);

        Alert::toast()->success('Gallery has been added!', 'Success');

        return redirect()->route('gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('pages.admin.gallery.edit', [
            'gallery' => $gallery,
            'packages' => TravelPackage::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();

        if ($request->file('image')) {
            // delete old image
            Storage::disk('public')->delete($gallery->image);

            $data['image'] = $request->file('image')->store(
                'assets/gallery',
                'public'
            );
        }

        $gallery->update($data);

        Alert::toast()->success('Gallery has been updated!', 'Success');

        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        Alert::toast()->success('Gallery has been deleted!', 'Success');

        return redirect()->route('gallery.index');
    }
}
