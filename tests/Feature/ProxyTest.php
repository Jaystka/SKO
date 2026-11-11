<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ProxyTest extends TestCase
{
    public function test_proxy_cleans_and_caches_response(): void
    {
        Http::fake([
            '*/provinces.json' => Http::response("\u{FEFF}[{\"id\":\"11\",\"name\":\"ACEH\"}]"),
        ]);

        $this->getJson('/api/proxy/provinces')->assertOk()->assertExactJson([['id' => '11', 'name' => 'ACEH']]);
        $this->getJson('/api/proxy/provinces')->assertOk();

        Http::assertSentCount(1);
    }

    public function test_proxy_rejects_non_numeric_ids(): void
    {
        Http::fake();

        $this->get('/api/proxy/regencies/abc')->assertNotFound();
        Http::assertNothingSent();
    }

    public function test_proxy_handles_upstream_failure(): void
    {
        Http::fake(['*' => Http::response('oops', 500)]);

        $this->getJson('/api/proxy/regencies/11')->assertStatus(502);
    }
}
