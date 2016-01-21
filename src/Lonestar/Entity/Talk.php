<?php

namespace Lonestar\Entity;

use Spot\Entity;

class Talk extends Entity
{
    protected static $table = 'talks';

    public static function fields()
    {
        return [
            'id' => ['type' => 'integer', 'autoincrement' => true, 'primary' => true],
            'title' => ['type' => 'string', 'length' => 255, 'required' => true],
            'abstract' => ['type' => 'text'],
            'category' => ['type' => 'string', 'length' => 40],
            'level' => ['type' => 'string', 'length' => 20],
            'speaker_id' => ['type' => 'integer', 'required' => true],
            'created_at' => ['type' => 'datetime', 'value' => new \DateTime()],
            'updated_at' => ['type' => 'datetime', 'value' => new \DateTime()],
        ];
    }

    public static function relations(\Spot\MapperInterface $mapper, \Spot\EntityInterface $entity)
    {
        return [
            'speakers' => $mapper->hasManyThrough($entity, 'Lonestar\Entity\Speaker', 'Lonestar\Entity\SpeakerTalk', 'speaker_id', 'talk_id'),
        ];
    }
}
