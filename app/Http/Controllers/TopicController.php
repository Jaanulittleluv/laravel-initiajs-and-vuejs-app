<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Image; // Add this line
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    public function index()
    {
        return Inertia::render('Topics/index', [
            'topics' => Topic::all()->map(function ($topic) {
                return [
                    'id' => $topic->id,
                    'name' => $topic->name,
                    'age' => $topic->age,
                    'status' => $topic->status,
                    'image' => asset('storage/' . $topic->image)
                ];
            })
        ]);
    }

    public function create()
    {
        return Inertia::render('Topics/Create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:150', 
            'status' => 'required|in:Active,Inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
          
            $imageName = $image->store('public/topics');
    
           
            $imagePath = Storage::url($imageName);
    
      
            $baseUrl = url('/');
            $imageUrl = str_replace($baseUrl, '', $imagePath);
            $imageUrl = str_replace('storage/', '', $imageUrl);
    
        } else {
            return Redirect::back()->with('error', 'No image uploaded.');
        }
    
        Topic::create([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'status' => $request->input('status'),
            'image' => $imageUrl 
        ]);
    
        return Redirect::route('dashboard');
    }
    
    

    public function edit(Topic $topic){
        return Inertia::render('Topics/Edit',['topic'=>$topic, 'image'=>asset('storage/' . $topic->image)]);
    }
    
    public function update(Topic $topic, Request $request) {
        $image = $topic->image;
    
        if ($request->file('image')) {
            Storage::delete('public/' . $topic->image);
            $image = $request->file('image')->store('topics', 'public');
        }
    
        $topic->update([
            'name' => $request->input('name'),
            'image' => $image,
        ]);
    
        return Redirect::route('dashboard');
    }

    public function destroy(Topic $topic){
        Storage::delete('public/'.$topic->image);
        $topic->delete();
        return Redirect::route('dashboard');
    }

    
    

}