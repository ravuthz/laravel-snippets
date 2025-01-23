<?php

namespace Tests\Unit;

use App\Services\PassportUtils;
use Tests\TestCase;

class PassportKeysTest extends TestCase
{

    public function test_encode_key()
    {
        $result = PassportUtils::encodeKey(storage_path('oauth-public.key'));
        $this->assertNotNull($result);
    }

    /**
     * A basic unit test example.
     */
    public function test_passport_keys_in_env(): void
    {
//        $publicKeyPath = storage_path('oauth-public.key');
//        $privateKeyPath = storage_path('oauth-private.key');

        $publicKeyPath = storage_path('test-public.key');
        $privateKeyPath = storage_path('test-private.key');

        $this->assertNotNull($publicKeyPath);
        $this->assertNotNull($privateKeyPath);

        PassportUtils::setKey($publicKeyPath, env('PASSPORT_PUBLIC_KEY'));
        PassportUtils::setKey($privateKeyPath, env('PASSPORT_PRIVATE_KEY'));

        [$resCode1, $output1] = PassportUtils::checkKey($publicKeyPath, true);
        [$resCode2, $output2] = PassportUtils::checkKey($privateKeyPath, false);

        $this->assertTrue($resCode1 == 0, 'Public key is invalid: ' . $output1);
        $this->assertTrue($resCode2 == 0, 'Private key is invalid: ' . $output2);

    }

}
