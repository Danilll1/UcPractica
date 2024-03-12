<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin()
    {
        $users = User::orderBy('id')->get();
        return view('admin.index', compact('users'));
    }
    public function admin2(Request $request)
    {
        $user = User::find($request->id);
        $user->Username = $request->Username;
        $user->Email = $request->Email;
        $user->Role = $request->Role;
        $user->save();

        return redirect()->back()->with('success', 'Данные успешно обновлены');
    }

    public function post()
    {
        $posts = Advertisement::orderBy('AdID')->get();
        return view('admin.posts', compact('posts'));
    }

    public function post2()
    {
        return view('post.check');
    }

    public function post3(Request $request)
    {
        $AdID = $request->input('AdID');
    
    if($AdID) {
        DB::table('advertisements')->where('AdID', '=', $AdID)->delete();
        return redirect()->back()->with('success', 'Post deleted successfully');
    } else {
        return redirect()->back()->with('error', 'Failed to delete post');
    }

    }
}
