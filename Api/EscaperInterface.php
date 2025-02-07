<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types = 1);

namespace MageWorx\FixSecureRenderer\Api;

interface EscaperInterface
{
    /**
     * Escape double quotes in the string.
     *
     * @param string $string
     * @return string
     */
    public function escapeDoubleQuotes(string $string): string;
}
