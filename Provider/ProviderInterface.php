<?php

namespace Chromedia\Bundle\MediaBundle\Provider;

use Chromedia\Bundle\MediaBundle\Model\Media;


interface ProviderInterface
{
    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @param array  $format
     * @return void
     */
    public function addFormat($name, array $format);

    /**
     * @param string $name
     * @return boolean
     */
    public function hasFormat($name);

    /**
     * @param string $name
     * @return array
     */
    public function getFormat($name);

    /**
     * @return array
     */
    public function getFormats();

    /**
     * @param array $formats
     * @return void
     */
    public function setFormats(array $formats);

    /**
     * @param Media $media
     * @param string $format
     * @return string
     */
    public function getMediaUrl(Media $media, $format = null);

    /**
     * @param \Chromedia\Bundle\MediaBundle\Model\Media $media
     * @return void
     */
    public function prepareMedia(Media $media);

    /**
     * @param \Chromedia\Bundle\MediaBundle\Model\Media $media
     * @return void
     */
    public function saveMedia(Media $media);

    /**
     * @param \Chromedia\Bundle\MediaBundle\Model\Media $media
     * @return void
     */
    public function updateMedia(Media $media);

    /**
     * @param \Chromedia\Bundle\MediaBundle\Model\Media $media
     * @return void
     */
    public function removeMedia(Media $media);

    /**
     * @return string
     */
    public function getTemplate();

    /**
     * @param \Chromedia\Bundle\MediaBundle\Model\Media $media
     * @param string $format
     * @param array $options
     * @return void
     */
    public function renderRaw(Media $media, $format = null, array $options = array());

    /**
     * @param \Chromedia\Bundle\MediaBundle\Model\Media $media
     * @param string $format
     * @param array $options
     * @return array Merged options
     */
    public function getRenderOptions(Media $media, $format, array $options = array());
}