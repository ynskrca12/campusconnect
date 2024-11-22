<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreCommentController extends Controller
{
    public function universite_yorum_ekle(Request $request,$id){

        // $universite = Universite::findOrFail($id);

        // $universite->comments()->create([
        //     "user_id" => auth()->id,
        //     "yorum"=> $request->input("comment"),
        //     "created_at" =>now()
        // ]);

        $commentData = [
            "user_id" => auth()->id(),
            "universite_id" => $id,
            "yorum" => $request->input("comment"),
            "created_at" => now(),
        ];

        // DB::table('universite_yorum')->insert($commentData);
        Comment::insert($commentData);


        return back();
    }
}
