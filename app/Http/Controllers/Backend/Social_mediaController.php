<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SocialMediaRequest;
use App\Models\Social_media;
use Illuminate\Http\Request;

class Social_mediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_social_media, show_social_media')) {
            return redirect('admin/index');
        }
        $Social_media = Social_media::all();
        return view('backend.Social_media.index', compact('Social_media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_social_media')) {
            return redirect('admin/index');
        }
        return view('backend.Social_media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialMediaRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_social_media')) {
            return redirect('admin/index');
        }
        $Social_media = new Social_media();
        $Social_media->name = $request->input('name');
        $Social_media->url = $request->input('url');
        $Social_media->save();
        return redirect()->route('admin.social_media.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'edit_social_media')) {
            return redirect('admin/index');
        }
        $Social_media = Social_media::find($id);
        return view('backend.Social_media.edit', compact('Social_media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialMediaRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'edit_social_media')) {
            return redirect('admin/index');
        }
        $Social_media = Social_media::find($id);
        $Social_media->name = $request->input('name');
        $Social_media->url = $request->input('url');
        $Social_media->save();
        return redirect()->route('admin.social_media.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_social_media')) {
            return redirect('admin/index');
        }
        $Social_media = Social_media::find($id);
        $Social_media->delete();
        return redirect()->route('admin.social_media.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
