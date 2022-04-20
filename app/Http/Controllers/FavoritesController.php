<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Request $request)
    {
        $micropost_id = $request->micropost_id;
        $userModel = \Auth::user();
        $user_id = $userModel->id;
        // お気に入り登録する
        $userModel->saveFavorite($user_id, $micropost_id);

        return back();
    }
    public function destroy(Request $request)
    {
        $micropost_id = $request->micropost_id;
        $userModel = \Auth::user();
        $user_id = $userModel->id;
     
        
        // お気に入り登録を解除する
        $userModel->saveunFavorite($user_id, $micropost_id);

        return back();
    }
}
