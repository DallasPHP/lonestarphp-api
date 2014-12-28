<?php

namespace Lonestar\Entity;

use Spot\Entity;

class Speaker extends Entity
{
    protected static $table = 'speakers';

    public static function fields()
    {
        return [
            'id' => ['type' => 'integer', 'autoincrement' => true, 'primary' => true],
            'first_name' => ['type' => 'string', 'length' => 40, 'required' => true],
            'last_name' => ['type' => 'string', 'length' => 40, 'required' => true],
            'company' => ['type' => 'string', 'length' => 100],
            'twitter' => ['type' => 'string', 'length' => 25],
            'bio' => ['type' => 'text'],
            'photo_path' => ['type' => 'string', 'length' => 255],
            'created_at' => ['type' => 'datetime', 'value' => new \DateTime()],
            'updated_at' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

    public static function relations(\Spot\MapperInterface $mapper, \Spot\EntityInterface $entity)
    {
        return [
            'talks' => $mapper->hasMany($entity, 'Lonestar\Entity\Talk', 'speaker_id'),
        ];
    }
}
