<?php

namespace Lonestar\Entity;

use Spot\Entity;

class SpeakerTalk extends Entity
{
    protected static $table = 'speaker_talks';

    public static function fields()
    {
        return [
            'id' => ['type' => 'integer', 'autoincrement' => true, 'primary' => true],
            'speaker_id' => ['type' => 'integer', 'required' => true, 'unique' => 'speaker_talk'],
            'talk_id' => ['type' => 'integer', 'required' => true, 'unique' => 'speaker_talk'],
            'created_at' => ['type' => 'datetime', 'value' => new \DateTime()],
            'updated_at' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

    public static function relations(\Spot\MapperInterface $mapper, \Spot\EntityInterface $entity)
    {
        return [
            'speaker' => $mapper->belongsTo($entity, 'Lonestar\Entity\Speaker', 'speaker_id'),
            'talk' => $mapper->belongsTo($entity, 'Lonestar\Entity\Talk', 'talk_id'),
        ];
    }
}
