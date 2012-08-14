<?php

namespace Chromedia\Bundle\MediaBundle\Generator\Uuid;

use Chromedia\Bundle\MediaBundle\Model\Media;

class DefaultUuidGenerator implements UuidGeneratorInterface
{
    public function generateUuid(Media $media)
    {
        return uniqid();
    }
}