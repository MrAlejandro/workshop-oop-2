<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\App;

class AppTest extends TestCase
{
    public function testEverythingWorks()
    {
        $app = new App();
        $this->assertEquals('yeap', $app->isEverythingOkay());
    }
}
