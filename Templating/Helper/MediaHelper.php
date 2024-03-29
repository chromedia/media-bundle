<?php

namespace Chromedia\Bundle\MediaBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Chromedia\Bundle\MediaBundle\MediaManager;
use Chromedia\Bundle\MediaBundle\Model\Media;

class MediaHelper extends Helper
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getMedia(Media $media, $format = null, array $options = array())
    {
        $context = $this->getMediaManager()->getContext($media->getContext());
        $provider = $context->getProvider();
        $options = $provider->getRenderOptions($media, $format, $options);

        if (null == $provider->getTemplate()) {
            return $provider->renderRaw($media, $format, $options);
        }

        return $this->container->get('templating')->render($provider->getTemplate(), array(
            'media' => $media,
            'format' => $format,
            'options' => $options,
        ));
    }

    /**
     * @return \Chromedia\Bundle\MediaBundle\MediaManager
     */
    public function getMediaManager()
    {
        return $this->container->get('chromedia_media.manager');
    }

    /**
     * {@inheritDoc}
     */
    function getName()
    {
        return 'media';
    }

}