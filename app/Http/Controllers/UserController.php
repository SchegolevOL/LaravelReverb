<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::query()->where('id','!=', auth()->user()->id)->withCount(['unreadMessages'])->get();

        return view('pages.chat-table', compact('users'));
    }

    public function userChat(int $userId)
    {
        return view('pages.chat', compact('userId'));
    }
}
