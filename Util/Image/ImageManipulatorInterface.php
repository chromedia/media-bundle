<?php

namespace Chromedia\Bundle\MediaBundle\Util\Image;

use Chromedia\Bundle\MediaBundle\Model\Media;
use Gaufrette\File;

interface ImageManipulatorInterface
{
    const RESIZE_MODE_OUTBOUND = 'outbound';
    const RESIZE_MODE_INSET = 'inset';

    public function resize(Media $media, File $fromFile, File $toFile, $options = array());
}