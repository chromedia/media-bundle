<?php

namespace Chromedia\Bundle\MediaBundle;

final class MediaEvents
{
    const BEFORE_PREPARE = 'chromedia_media.before_prepare';
    const AFTER_PREPARE = 'chromedia_media.after_prepare';

    const BEFORE_SAVE = 'chromedia_media.before_save';
    const AFTER_SAVE = 'chromedia_media.after_save';

    const BEFORE_UPDATE = 'chromedia_media.before_update';
    const AFTER_UPDATE = 'chromedia_media.after_update';

    const BEFORE_REMOVE = 'chromedia_media.before_remove';
    const AFTER_REMOVE = 'chromedia_media.after_remove';
}