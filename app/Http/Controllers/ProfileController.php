<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileView(Request $request)
    {
        return view('profile/profileuser', ['customer' => $request->user()]);
    }

    public function index(Request $request)
    {
        return view('profile/editprofileuser', ['customer' => $request->user()]);
    }

    /**
     * Parameter route diabaikan: customer hanya bisa mengubah profilnya sendiri.
     */
    public function update(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s()]{8,20}$/'],
            'address' => ['nullable', 'string', 'max:1000'],
        ], [
            'phone.regex' => 'Format nomor HP tidak valid.',
        ]);

        $request->user()->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
        }

        return redirect()->route('profileView')->with('success', 'Profil berhasil diperbarui.');
    }
}
