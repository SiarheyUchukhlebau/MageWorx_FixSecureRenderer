<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types = 1);

namespace MageWorx\FixSecureRenderer\Test\Unit\Model;

use MageWorx\FixSecureRenderer\Model\Escaper;

class EscaperTest extends \PHPUnit\Framework\TestCase
{
    public function testEscapeDoubleQuotes_escapesUnescapedDoubleQuotes(): void
    {
        $escaper  = new Escaper();
        $input    = '#options_279_file input[type="checkbox"]';
        $expected = '#options_279_file input[type=\"checkbox\"]';
        $this->assertEquals($expected, $escaper->escapeDoubleQuotes($input));
    }

    public function testEscapeDoubleQuotes_doesNotEscapeAlreadyEscapedDoubleQuotes(): void
    {
        $escaper  = new Escaper();
        $input    = '#options_279_file input[type=\"checkbox\"]';
        $expected = '#options_279_file input[type=\"checkbox\"]';
        $this->assertEquals($expected, $escaper->escapeDoubleQuotes($input));
    }

    public function testEscapeDoubleQuotes_handlesEmptyString(): void
    {
        $escaper  = new Escaper();
        $input    = '';
        $expected = '';
        $this->assertEquals($expected, $escaper->escapeDoubleQuotes($input));
    }

    public function testEscapeDoubleQuotes_handlesStringWithoutDoubleQuotes(): void
    {
        $escaper  = new Escaper();
        $input    = '#options_279_file input[type=checkbox]';
        $expected = '#options_279_file input[type=checkbox]';
        $this->assertEquals($expected, $escaper->escapeDoubleQuotes($input));
    }

    public function testEscapeDoubleQuotes_handlesMultipleUnescapedDoubleQuotes(): void
    {
        $escaper  = new Escaper();
        $input    = '"input" "type" "checkbox"';
        $expected = '\"input\" \"type\" \"checkbox\"';
        $this->assertEquals($expected, $escaper->escapeDoubleQuotes($input));
    }
}
