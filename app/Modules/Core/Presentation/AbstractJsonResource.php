<?php

namespace App\Modules\Core\Presentation;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * Classe base para serialização da camada de apresentação.
 *
 * Aqui ficam concentrados todos os métodos auxiliares utilizados nos resources.
 */
abstract class AbstractJsonResource extends JsonResource
{
    protected function asDate(?Carbon $date)
    {
        if ($date) return $date->format('Y-m-d');
    }

    protected function asDateAndTime(?Carbon $date)
    {
        if ($date) return $date->format('Y-m-d H:i');
    }

    protected function asDateAndTimeWithSeconds(?Carbon $date)
    {
        if ($date) return $date->format('Y-m-d H:i:s');
    }

    /**
     * Create a new resource instance.
     *
     * @param  mixed  ...$parameters
     * @return static
     */
    public static function make(...$parameters)
    {
        return new static(...$parameters);
    }


    public static function collection($resource)
    {
        /** @var AnonymousResourceCollection $data */
        $data =  tap(new AnonymousResourceCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });


        $resource = $data->resource->toArray();

        if (Arr::get($resource, 'current_page')) {
            $data->with['meta']['page'] = [
                    'count' => Arr::get($resource, 'total'),
                    'size' => Arr::get($resource, 'per_page'),
                    'number' => Arr::get($resource, 'current_page'),
                    'last' => Arr::get($resource, 'last_page'),
                    'next' => Arr::get($resource, 'current_page') + 1,
                    'previous' => Arr::get($resource, 'current_page') - 1,
                ];
        }
        return $data;
    }
}
