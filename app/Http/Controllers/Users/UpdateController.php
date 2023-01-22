<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;


class UpdateController extends Controller
{

    public function __invoke(User $user, UpdateRequest $request)
    {
        $this->authorize('view', $user);
        $data = $request->validated();

        if ($request->hasFile('picture')) {
            if ($user->picture != "icons/user.png")
                unlink(public_path() . "/storage/" . $user->picture);

            $paths = $data["picture"]->store('icons', 'public');
            $data["picture"] = $paths;
        }


        $user->update($data);
        return redirect()->route('users.show', $user->id);

    }
}
