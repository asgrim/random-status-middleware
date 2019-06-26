<?php

declare(strict_types=1);

namespace Asgrim\RandomStatusMiddleware;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function array_filter;
use function count;
use function random_int;

final class RandomStatusMiddleware implements MiddlewareInterface
{
    /** @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Status retrieved 26/06/2019 */
    private const STATUS_CODES_TO_PICK_FROM = [
        100,
        101,
        102,
        103,
        200,
        201,
        202,
        203,
        204,
        205,
        206,
        207,
        208,
        226,
        300,
        301,
        302,
        303,
        304,
        305,
        306,
        307,
        308,
        400,
        401,
        402,
        403,
        404,
        405,
        406,
        407,
        408,
        409,
        410,
        411,
        412,
        413,
        414,
        415,
        416,
        417,
        418,
        421,
        422,
        423,
        424,
        425,
        426,
        428,
        429,
        431,
        451,
        500,
        501,
        502,
        503,
        504,
        505,
        506,
        507,
        508,
        510,
        511,
    ];

    /** @throws Exception */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $response = $handler->handle($request);

        $statusCodesToPickFrom = array_diff(
            self::STATUS_CODES_TO_PICK_FROM,
            [
                $response->getStatusCode()
            ]
        );

        return $response->withStatus($statusCodesToPickFrom[random_int(0, count($statusCodesToPickFrom) - 1)]);
    }
}
