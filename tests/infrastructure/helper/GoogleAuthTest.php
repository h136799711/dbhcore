<?php

declare(strict_types=1);

namespace byTest\infrastructure\helper;

use by\component\helper\GoogleAuthHelper;
use PHPUnit\Framework\TestCase;

final class GoogleAuthTest extends TestCase
{
    public function testQTop(): void
    {
        $helper = new GoogleAuthHelper();
        $secret = $helper->createSecret(32);
        echo $secret, "\n";

        $this->assertEquals(32, strlen($secret), "密钥不是32位长度");
        $name = "dbh_core_account@gmail.com";
        $title = "dbh_core_brand";
        $qrcode = $helper->getQRCodeGoogleUrl($name, $secret, $title);
        echo $qrcode, "\n";
        $code = $helper->getCode($secret);
        echo $code, "\n";
        $this->assertTrue($helper->verifyCode($secret, $code, 10));


        $fixedSecret = "3EJ5EAVYFUB55WAUP6MMSVSEAOTP7KUP";
        $this->assertFalse($helper->verifyCode($fixedSecret, "649493"));
        $this->assertFalse($helper->verifyCode($fixedSecret, "696527"));
    }
}
