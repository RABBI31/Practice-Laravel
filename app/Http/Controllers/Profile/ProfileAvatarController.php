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
dd($request->all());
            return redirect(route('profile.edit'));
        }
}
