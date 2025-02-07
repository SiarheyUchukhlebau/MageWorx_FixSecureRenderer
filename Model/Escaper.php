<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types = 1);

namespace MageWorx\FixSecureRenderer\Model;

use MageWorx\FixSecureRenderer\Api\EscaperInterface;

class Escaper implements EscaperInterface
{
    /**
     * @inheritDoc
     *
     * Test strings:
     * Input: #options_279_file input[type="checkbox"]
     * Output: #options_279_file input[type=\"checkbox\"]
     *
     * Input: #options_279_file input[type=\"checkbox\"]
     * Output: #options_279_file input[type=\"checkbox\"]
     */
    public function escapeDoubleQuotes(string $string): string
    {
        // Replace unescaped double quotes with escaped double quotes
        return preg_replace('/(?<!\\\\)"/', '\"', $string);
    }
}
