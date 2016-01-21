<?php
namespace Lonestar\Transformer;

use Lonestar\Entity\Talk as TalkEntity;
use Lonestar\Transformer\Speaker as SpeakerTransformer;
use League\Fractal\TransformerAbstract;

class Talk extends TransformerAbstract
{

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $availableIncludes = [
        'speakers'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param Lonestar\Entity\Talk $talk talk entity
     * @return array
     */
    public function transform(TalkEntity $talk)
    {
        return [
            'id'       => (int) $talk->id,
            'title'    => $talk->title,
            'abstract' => $talk->abstract,
            'category' => $talk->category,
            'level'    => $talk->level,
            'slug'     => $talk->slug ?: $this->generateSlug($talk->title),
        ];
    }

    /**
     * Include Speakers
     *
     * @param Lonestar\Entity\Talk $talk talk entity
     * @return League\Fractal\Resource\Collection
     */
    public function includeSpeakers(TalkEntity $talk)
    {
        $speakers = $talk->speakers;

        return $this->collection($speakers, new SpeakerTransformer);
    }

    /**
     * Sluggify title for proper url linking
     *
     * @param string $title talk title
     * @return string
     */
    protected function generateSlug($title)
    {
        $titleTrimmed = preg_replace(
            "([^a-zA-Z0-9\s])",
            "",
            $title
        );

        return strtolower(str_replace(
            " ",
            "-",
            $titleTrimmed
        ));
    }

}
