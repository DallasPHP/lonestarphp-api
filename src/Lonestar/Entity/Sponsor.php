<?php

namespace Lonestar\Entity;

use Spot\Entity;

class Sponsor extends Entity
{
    protected static $table = 'sponsors';

    public static function fields()
    {
        return [
            'id' => ['type' => 'integer', 'autoincrement' => true, 'primary' => true],
            'name' => ['type' => 'string', 'length' => 100, 'required' => true],
            'url' => ['type' => 'string', 'length' => 255, 'required' => true],
            'sponsor_level' => ['type' => 'integer', 'length' => 1, 'required' => true],
            'description' => ['type' => 'text', 'required' => true],
            'logo_path' => ['type' => 'string', 'length' => 255, 'required' => true],
            'created_at' => ['type' => 'datetime', 'value' => new \DateTime()],
            'updated_at' => ['type' => 'datetime', 'value' => new \DateTime()],
        ];
    }
}
