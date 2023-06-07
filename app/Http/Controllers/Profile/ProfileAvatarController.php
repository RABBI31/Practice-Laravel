<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileAvatarController extends Controller
{
        public function update( Request $request){
$request->validate([
'avatar'=>'image',
]);
            $path = $request->file('avatar')->store('avatars','public');
            auth()->user()->update(['avatar' => "$path"]);
            return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
        }
}
