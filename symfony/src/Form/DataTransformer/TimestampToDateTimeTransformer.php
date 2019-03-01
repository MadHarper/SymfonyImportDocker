<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TimestampToDateTimeTransformer implements DataTransformerInterface
{

    /**
     * @param \DateTime $dateTime
     */
    public function transform($dateTime = null)
    {
        if($dateTime === null)
        {
            return (new \DateTime('now'))->getTimestamp();
        }
        return $dateTime->getTimestamp();
    }

    public function reverseTransform($timestamp)
    {
        return (new \DateTime())->setTimestamp($timestamp);
    }

}