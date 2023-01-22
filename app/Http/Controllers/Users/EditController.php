<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class EditController extends Controller
{

    public function __invoke(User $user)
    {
        $this->authorize('view', $user);
        $title = "Редактирование страницы";
        return view('users.edit', compact('user', 'title'));
    }
}
