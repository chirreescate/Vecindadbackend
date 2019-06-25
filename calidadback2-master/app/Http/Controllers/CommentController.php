<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Notifications\TicketCommented;
use Notification;
use Illuminate\Support\Facades\Log;
use App\User;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();

        $comment = new Comment();

        $comment->ticket_id = $request->ticket_id;
        $comment->message = $request->message;
        $comment->user_id = $user->id;

        $comment->save();

        $notifiable_ids = Comment::select('user_id')
            ->where('ticket_id', $request->ticket_id)
            ->where('user_id', '!=', $user->id)
            ->distinct()
            ->pluck('user_id')
            ->toArray();

        $notifiables = User::whereIn('id', $notifiable_ids)->get();
        $comment->user;
        $comment->ticket;

        Notification::send($notifiables, new TicketCommented($comment->toArray()));

        return response()->json([ 'message' => 'Successfully created'], 201);
    }

    public function listByTicket(Request $request,$id)
    {
        $comments = Comment::where('ticket_id',$id)->get();

        return response()->json([ 'comments' => $comments], 201);
    }
}
