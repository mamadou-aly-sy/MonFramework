<?php

namespace Test\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testTrailingSlashes()
    {
        $app = new App([]);
        $request = new ServerRequest("GET", "/demo/");
        $response = $app->run($request);

        $this->assertContains('/demo', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testHome()
    {
        $app = new App([]);
        $request = new ServerRequest("GET", "/home");
        $response = $app->run($request);

        $this->assertEquals("<h1>Home</h1>", (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testError()
    {
        $app = new App([]);
        $request = new ServerRequest("GET", "/trtgv");
        $response = $app->run($request);

        $this->assertEquals("<h1>Error 404</h1>", (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
