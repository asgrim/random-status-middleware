<?php

declare(strict_types=1);

namespace AsgrimUnitTest\RandomStatusMiddleware;

use Asgrim\RandomStatusMiddleware\RandomStatusMiddleware;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

/** @covers \Asgrim\RandomStatusMiddleware\RandomStatusMiddleware */
final class RandomStatusMiddlewareTest extends TestCase
{
    /** @throws Exception */
    public function testStatusCodeIsChangedFromOriginal() : void
    {
        self::assertNotSame(
            100,
            (new RandomStatusMiddleware())
                ->process(
                    new ServerRequest(),
                    new class implements RequestHandlerInterface {
                        public function handle(ServerRequestInterface $request) : ResponseInterface
                        {
                            return (new Response())->withStatus(100);
                        }
                    }
                )
                ->getStatusCode()
        );
    }
}
