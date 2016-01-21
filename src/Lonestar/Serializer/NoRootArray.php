<?php
namespace Lonestar\Serializer;

use League\Fractal\Serializer\ArraySerializer;

class NoRootArray extends ArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return $data;
    }
}
