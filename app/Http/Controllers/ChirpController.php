<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Events\ChirpUpdated;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $chirps = Chirp::with('user')->orderBy('id', 'desc')->get();

        return view('chirps.index', compact('chirps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('chirps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
 
        $request->user()->chirps()->create($validated);
 
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp): View
    {
        return view('chirps.show', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp): View
    {
        Gate::authorize('update', $chirp);
 
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Chirp $chirp): RedirectResponse
{
    Gate::authorize('update', $chirp);
 
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // データを更新
    $chirp->update($validated);

    // 手動で ChirpUpdated イベントを発火
    event(new ChirpUpdated($chirp));

    // ログの出力（デバッグ用）
    \Log::info('Chirp created at: ' . $chirp->created_at);
    \Log::info('Chirp updated at: ' . $chirp->updated_at);

    return redirect(route('chirps.index'))->with('success', 'Chirp updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        Gate::authorize('delete', $chirp);
 
        $chirp->delete();
 
        return redirect(route('chirps.index'));
    }
}

