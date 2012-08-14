<?php

namespace Chromedia\Bundle\MediaBundle\Generator\Path;

use Chromedia\Bundle\MediaBundle\Model\Media;

interface PathGeneratorInterface
{
    public function generatePath(Media $media, $format = null);
}