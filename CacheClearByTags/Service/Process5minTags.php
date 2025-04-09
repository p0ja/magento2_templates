<?php

declare(strict_types=1);

namespace Vendor\CacheClearByTags\Service;

use Vendor\CacheClearByTags\Tags\ClearTagsList;
use Magento\Framework\App\CacheInterface;

class Process5minTags
{
    /**
     * @param CacheInterface $cache
     */
    public function __construct(
        private readonly CacheInterface $cache
    ) {
    }

    /**
     * @return bool
     */
    public function cleanCacheByTag(): bool
    {
        $tags = ClearTagsList::TAGS_EVERY_5MIN;
        $tags[] = $this->cache->load('customer_rma_list__0_2219-009-034-004-0004');

        return $this->cache->clean($tags);
    }
}
