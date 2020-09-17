<?php
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * App class
 */
class App
{

    private $modules;

    public function __construct(array $modules)
    {
        $this->modules = $modules;
    }

    /**
     * App run method
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[-1] == "/") {
            return (new Response())
                ->withHeader('Location', substr($uri, 0, -1))
                ->withStatus(301);
        }
        if ($uri == "/home") {
            return new Response(200, [], "<h1>Home</h1>");
        }
        return new Response(404, [], "<h1>Error 404</h1>");
    }
}
