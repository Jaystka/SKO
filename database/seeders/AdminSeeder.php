<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Membuat akun admin dari env ADMIN_EMAIL & ADMIN_PASSWORD.
 * Tidak ada password default yang di-hardcode.
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            $this->command?->warn('ADMIN_EMAIL / ADMIN_PASSWORD belum di-set, akun admin tidak dibuat.');

            return;
        }

        if (strlen($password) < 12) {
            $this->command?->error('ADMIN_PASSWORD minimal 12 karakter.');

            return;
        }

        User::updateOrCreate(['email' => $email], [
            'name' => env('ADMIN_NAME', 'Admin SKO'),
            'password' => $password,
        ]);

        $this->command?->info("Akun admin {$email} siap.");
    }
}
