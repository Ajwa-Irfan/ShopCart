<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index() {
        $sliders = Slider::latest()->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create() {
        return view('admin.sliders.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $path = $request->file('image')->store('sliders', 'public');
        Slider::create(['title' => $request->title, 'image' => $path, 'status' => $request->has('status') ? 1 : 0]);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider added!');
    }

    public function edit(Slider $slider) {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider) {
        $request->validate(['title' => 'required|string|max:255']);
        $data = ['title' => $request->title, 'status' => $request->has('status') ? 1 : 0];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image);
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }
        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated!');
    }

    public function destroy(Slider $slider) {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted!');
    }
}
