<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Proxy data wilayah Indonesia (provinsi/kabupaten/kecamatan/desa) dengan cache,
 * timeout, dan validasi parameter.
 */
class ProxyController extends Controller
{
    private const BASE_URL = 'https://jaystka.github.io/api-wilayah-indonesia/api';

    public function getProvinces(): JsonResponse
    {
        return $this->fetch('provinces.json');
    }

    public function getRegencies(string $provinceId): JsonResponse
    {
        return $this->fetch("regencies/{$provinceId}.json");
    }

    public function getDistricts(string $regencyId): JsonResponse
    {
        return $this->fetch("districts/{$regencyId}.json");
    }

    public function getVillages(string $districtId): JsonResponse
    {
        return $this->fetch("villages/{$districtId}.json");
    }

    private function fetch(string $path): JsonResponse
    {
        $data = Cache::get('wilayah:'.$path);

        if ($data === null) {
            try {
                $response = Http::timeout(10)->retry(2, 200, throw: false)->get(self::BASE_URL.'/'.$path);
            } catch (Throwable $e) {
                Log::warning('Wilayah API tidak dapat diakses', ['path' => $path, 'error' => $e->getMessage()]);

                return response()->json(['message' => 'Layanan data wilayah tidak tersedia.'], 502);
            }

            if ($response->status() === 404) {
                return response()->json(['message' => 'Data wilayah tidak ditemukan.'], 404);
            }

            // Sebagian file JSON sumber diawali karakter sampah sebelum "[".
            $body = $response->body();
            $start = strpos($body, '[');
            $data = $start === false ? null : json_decode(substr($body, $start), true);

            if (! $response->successful() || ! is_array($data)) {
                return response()->json(['message' => 'Layanan data wilayah tidak tersedia.'], 502);
            }

            $data = array_map(fn ($row) => [
                'id' => (string) ($row['id'] ?? ''),
                'name' => (string) ($row['name'] ?? ''),
            ], $data);

            Cache::put('wilayah:'.$path, $data, now()->addDays(7));
        }

        return response()->json($data)->header('Cache-Control', 'public, max-age=86400');
    }
}
