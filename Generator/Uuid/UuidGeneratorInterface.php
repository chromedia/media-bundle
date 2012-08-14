<?php

namespace Chromedia\Bundle\MediaBundle\Generator\Uuid;

use Chromedia\Bundle\MediaBundle\Model\Media;

interface UuidGeneratorInterface
{
    public function generateUuid(Media $media);
}