<?php

namespace Chromedia\Bundle\MediaBundle\Twig\Extension;

use Chromedia\Bundle\MediaBundle\Templating\Helper\MediaHelper;
use Chromedia\Bundle\MediaBundle\Model\Media;

class MediaExtension extends \Twig_Extension
{
    /**
     * @var MediaHelper
     */
    protected $helper;

    public function __construct(MediaHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'media' => new \Twig_Function_Method($this, 'getMedia'),
        );
    }

    public function getMedia(Media $media, $format = null, array $options = array())
    {
        return $this->helper->getMedia($media, $format, $options);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'media';
    }
}
