<?php
/*
 * This file is part of the Sulu CMS.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Component\Content\Types\Rlp\Strategy;

use Sulu\Component\Content\Types\Rlp\Mapper\RlpMapperInterface;

/**
 * implements RLP Strategy "as short as possible"
 */
class TreeStrategy extends RlpStrategy
{
    /**
     * @param RlpMapperInterface $mapper
     */
    public function __construct(RlpMapperInterface $mapper)
    {
        parent::__construct('whole-tree', $mapper);
    }

    /**
     * internal generator
     * @param $title
     * @param $parentPath
     * @return string
     */
    protected function generatePath($title, $parentPath)
    {
        // concat parentPath and title to whole tree path
        return $parentPath . '/' . $title;
    }
}
