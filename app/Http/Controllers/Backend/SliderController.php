<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SliderRequest;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SliderController extends Controller
{
    use LivewireAlert;

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_sliders, show_sliders')) {
            return redirect('admin/index');
        }
        $sliders = Slide::all();
        return view('backend.slider.index', compact('sliders'));
    }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'edit_sliders')) {
            return redirect('admin/index');
        }
        $slider = Slide::find($id);
        return view('backend.slider.edit', compact('slider'));
    }

    public function update(SliderRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'edit_sliders')) {
            return redirect('admin/index');
        }
        $slider = Slide::find($id);
        $slider->Inspiration = $request->input('Inspiration');
        $slider->offer = $request->input('offer');
        $slider->link = $request->input('link');


        if ($request->hasFile('Covers')) {
            $destinationPath = public_path('/assets/slider/');
            if (File::exists($destinationPath . $slider->Covers)) {
                File::delete($destinationPath . $slider->Covers);
            }
            $file = $request->file('Covers');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move($destinationPath, $filename);
            $slider->Covers = $filename;
        }

        $slider->save();

        return redirect()->route('admin.slider.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);


    }
}
