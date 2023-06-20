<?php
use App\Models\User;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\ProfileAvatarController;
use App\Http\Controllers\Auth\LoginProviderController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('welcome')
$user=User::find(1);
$user->update([
'email'=>'ali@gmail.com'
]);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileAvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->stateless()->user();
$user=User::updateorCreate(['email'=> $user->email],
[
'name'      =>$user->name,
'password'  =>'password',
]);
Auth::login($user);
return redirect('/dashboard');
});

Route::get('login/github', [LoginProviderController::class, 'redirectToProvider']);
Route::get('login/github/callback', [LoginProviderController::class, 'handleProviderCallback']);
