<?php

namespace Chromedia\Bundle\MediaBundle\Model\Manager;

use Chromedia\Bundle\MediaBundle\Model\Factory;
use Chromedia\Bundle\MediaBundle\Model\MediaGroupInterface;
use Chromedia\Bundle\MediaBundle\Repository\MediaGroupRepositoryInterface;

class MediaGroupManager implements MediaGroupManagerInterface
{
    protected $mediaGroupRepository;
    protected $factory;

    public function __construct(
        MediaGroupRepositoryInterface $mediaGroupRepository,
        Factory $factory
    )
    {
        $this->mediaGroupRepository = $mediaGroupRepository;
        $this->factory = $factory;
    }

    function getMediaGroupBy(array $criteria)
    {
        return $this->mediaGroupRepository->findOneBy($criteria);
    }

    public function saveOrUpdateMediaGroup(MediaGroupInterface $mediaGroup)
    {
        $this->mediaGroupRepository->save($mediaGroup);
    }
}