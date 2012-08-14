<?php

namespace Chromedia\Bundle\MediaBundle\Provider;

use Chromedia\Bundle\MediaBundle\Model\Media;
use Chromedia\Bundle\MediaBundle\Util\Image\ImageManipulatorInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Chromedia\Bundle\MediaBundle\File\ExtensionGuesser;

class ImageProvider extends FileProvider
{
    /* @var \Chromedia\Bundle\MediaBundle\Util\Image\ImageManipulatorInterface */
    protected $imageManipulator;


    /**
     * {@inheritDoc}
     */
    public function prepareMedia(Media $media)
    {
        if (!parent::prepareMedia($media)) {
            return false;
        }

        $metadata = $media->getMetadata();
        list($metadata['width'], $metadata['height']) = @getimagesize($media->getContent()->getRealPath());
        $media->setMetadata($metadata);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function saveMedia(Media $media)
    {
        if (parent::saveMedia($media)) {
            $this->generateFormats($media);
        }
    }

    public function generateFormats(Media $media)
    {
        $originalFile = $this->getOriginalFile($media);

        foreach($this->formats as $format => $options) {
            $this->imageManipulator->resize(
                $media,
                $originalFile,
                $this->filesystem->get($this->pathGenerator->generatePath($media, $format), true),
                $options
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getRenderOptions(Media $media, $format, array $options = array())
    {
        return $options;
    }

    public function setImageManipulator(ImageManipulatorInterface $imageManipulator)
    {
        $this->imageManipulator = $imageManipulator;
    }
}