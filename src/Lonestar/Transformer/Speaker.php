<?php
namespace Lonestar\Transformer;

use Lonestar\Entity\Speaker as SpeakerEntity;
use Lonestar\Transformer\Talk as TalkTransformer;
use League\Fractal\TransformerAbstract;

class Speaker extends TransformerAbstract
{

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $availableIncludes = [
        'talks'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Lonestar\Entity\Speaker $speaker speaker entity
     * @return array
     */
    public function transform(SpeakerEntity $speaker)
    {
        return [
            'id'         => (int) $speaker->id,
            'first_name' => $speaker->first_name,
            'last_name'  => $speaker->last_name,
            'company'    => $speaker->company,
            'twitter'    => $speaker->twitter,
            'bio'        => $speaker->bio,
            'photo_path' => $speaker->photo_path,
        ];
    }

    /**
     * Include Talks
     *
     * @param Lonestar\Entity\Speaker $speaker speaker entity
     * @return League\Fractal\Resource\Collection
     */
    public function includeTalks(SpeakerEntity $speaker)
    {
        $talks = $speaker->talks;

        return $this->collection($talks, new TalkTransformer);
    }

}
