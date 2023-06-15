<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileAvatarController extends Controller
{
        public function update( Request $request){
$request->validate([
'avatar'=>'image',
]);
            // $path = $request->file('avatar')->store('avatars','public');
$path=Storage::disk('public')->put('avatars', $request->file('avatar'));
if($oldavatar = $request->user()->avatar){
Storage::disk('public')->delete($oldavatar);
}
            auth()->user()->update(['avatar' => "$path"]);
            return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
        }
}
