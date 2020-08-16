<?php

namespace App\Http\Controllers\ForeCast;

use App\Http\Controllers\ApiController;
use Base\ForeCasts\Forecast\Infrastructure\CityNotFound;
use Base\ForeCasts\Forecast\Infrastructure\ForeCast;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ForeCastGetController extends ApiController
{
    /**
     * @OA\Post(
     * path="/api/v1/forecast/get",
     * summary="City forecast",
     * description="Get city forecast by city name and country code",
     * @OA\RequestBody(
     *    required=true,
     *    description="City and Country Code",
     *    @OA\JsonContent(
     *       required={"city","country_code"},
     *       @OA\Property(property="city", type="string", example="London"),
     *       @OA\Property(property="country_code", type="string", example="GB"),
     *    ),
     * ),
     * @OA\Response(
     *    response=400,
     *    description="The given data was invalid",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="string", example="The given data was invalid")
     *        )
     *     )
     * )
     * @param Request  $request
     * @param ForeCast $forecastService
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, ForeCast $forecastService): JsonResponse
    {
        try {
            $request->validate(
                [
                    'city'         => 'required|string',
                    'country_code' => 'required|string'
                ]
            );

            $city        = $request->city;
            $countryCode = $request->country_code;

            /** @var @ForeCastResponse $response */
            $response = $forecastService->getForecastByCity($city, $countryCode);
        } catch (\Exception $exception) {
            $code = $this->getExceptionCode($exception);
            return (new JsonResponse(['error' => $exception->getMessage()], $code))->send();
        }

        return (new JsonResponse($response->toPrimitives(), Response::HTTP_OK))->send();
    }

    protected function exceptions(): array
    {
        return [
            CityNotFound::class => Response::HTTP_BAD_REQUEST
        ];
    }
}
