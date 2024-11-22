<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteCommentController extends Controller
{
    public function universite_yorum_sil($id, Comment $comment)
    {
        $comment->delete();
        return back();
    }

}
