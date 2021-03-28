<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\AnnouncementRequest;

class HomeController extends Controller
{
    public function index ()
    {
        $announcements = Announcement::where('is_accepted',true)
                                    ->orderBy('id', 'desc')->paginate(5);

        //$announcements = Announcement::orderBy('id', 'desc')->paginate(5);
        return view('welcome', compact('announcements'));
    }

    public function newAnnouncement ()
    {
        return view('announcements.new');
    }
    
    public function createAnnouncement(AnnouncementRequest $request)
    {
        $a = new Announcement();
        $a->name = $request->input('name');
        $a->description = $request->input('description');
        $a->price = $request->input('price');
        $a->user_id = Auth::id();
        $a->category_id = $request->input('category');
        $a->save();
        
        return redirect()->route('home')->with('announcement.create.success','Anuncio creado con exito');
    }

    public function detailCategory($id)
    {
        $category = Category::findOrFail($id);
        $announcements = $category->announcements()
                                    ->where('is_accepted',true)
                                    ->orderBy('id', 'desc')->paginate(5);
        
        return view('announcements.detailcategory', compact('category','announcements'));

        /* $category = Category::findOrFail($id);
        return view('announcements.detailcategory', compact('category')); */
    }

    public function detailAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.detail', compact('announcement'));
    }
}