<?php

namespace Chromedia\Bundle\MediaBundle\Generator\Path;

use Chromedia\Bundle\MediaBundle\Model\Media;
use Chromedia\Bundle\MediaBundle\Util\File;

class DefaultPathGenerator implements PathGeneratorInterface
{
    public function generatePath(Media $media, $format = null)
    {
        if (empty($format)) {
            return sprintf(
                '%s/%s.%s',
                $media->getContext(),
                $media->getUuid(),
                ExtensionGuesser::guess($media->getContentType())
            );
        }

        return sprintf(
            '%s/%s_%s.%s',
            $media->getContext(),
            $media->getUuid(),
            $format,
            ExtensionGuesser::guess($media->getContentType())
        );
    }
}