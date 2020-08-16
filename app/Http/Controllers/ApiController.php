<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Base\Shared\Infrastructure\Symfony\ApiExceptionsHttpStatusCodeMapping;
use Symfony\Component\HttpFoundation\Response;
use function Lambdish\Phunctional\each;

abstract class ApiController
{

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Project demo API documentation",
     *      description="A description for the API",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )
     * @param ApiExceptionsHttpStatusCodeMapping $exceptionHandler
     */
    public function __construct(
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler
    )
    {
        each(
            fn(int $httpCode, string $exceptionClass) => $exceptionHandler->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    abstract protected function exceptions(): array;

    /**
     * @param \Exception $exception
     *
     * @return int|mixed
     */
    public function getExceptionCode(\Exception $exception)
    {
        return isset($this->exceptions()[get_class($exception)]) ? $this->exceptions()[get_class(
            $exception
        )] : Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
