<?php
namespace App\Http\Controllers;

use App\Product;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;

        $comment->comment = $request->comment;

        $comment->user()->associate($request->user());

        $product = Product::find($request->product_id);

        $product->comments()->save($comment);
/*
        $comment=DB::table('comment')->where('product_id',$id)->get();
*/
        return back();
    }
    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $product = Product::find($request->get('product_id'));

        $product->comments()->save($reply);

        return back();

    }
    
    
}