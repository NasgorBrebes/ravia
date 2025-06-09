    <?php

    use App\Http\Controllers\EventController;
    use App\Http\Controllers\GuestController;
    use App\Http\Controllers\WebController;
    use App\Http\Controllers\StoryController;
    use App\Http\Controllers\GalleryController;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;

    Route::get('/', function () {
        return view('index');
    });

    Route::middleware('auth')->group(function () {
        // Dashboard routes
        Route::get('/dashboard', [WebController::class, 'index'])->name('dashboard');

        // Event routes
        Route::post('/update/event', [EventController::class, 'update'])->name('event.update');

        // Guest routes
        Route::post('/guest', [GuestController::class, 'store'])->name('guest.store');
        Route::patch('/guest/{guest}', [GuestController::class, 'update'])->name('guest.update');
        Route::delete('/guest/{guest}', [GuestController::class, 'destroy'])->name('guest.destroy');

        // Story routes
        Route::get('/stories', [StoryController::class, 'index'])->name('stories.index'); // API response (JSON)
        Route::post('/stories/add', [StoryController::class, 'store'])->name('stories.store');
        Route::put('/stories/{id}', [StoryController::class, 'update'])->name('stories.update'); // Mengupdate 1 cerita

        // Gallery routes
        Route::get('/admin/gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

        // Logout route
        Route::post('/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/');
        })->name('logout');
    });

    require __DIR__.'/auth.php';
