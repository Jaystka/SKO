<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProxyController extends Controller
{
    protected $apiBaseUrl = 'https://jaystka.github.io/api-wilayah-indonesia/api';

    public function getProvinces()
    {
        $response = Http::get("{$this->apiBaseUrl}/provinces.json");
        return $response->body();
    }

    public function getRegencies($provinceId)
    {
        $response = Http::get("{$this->apiBaseUrl}/regencies/{$provinceId}.json");
        return $response->body();
    }

    public function getDistricts($regencyId)
    {
        $response = Http::get("{$this->apiBaseUrl}/districts/{$regencyId}.json");
        return $response->body();
    }

    public function getVillages($districtId)
    {
        $response = Http::get("{$this->apiBaseUrl}/villages/{$districtId}.json");
        return $response->body();
    }
}
