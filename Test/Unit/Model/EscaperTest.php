<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace MageWorx\FixSecureRenderer\Test\Unit\Model;

use MageWorx\FixSecureRenderer\Model\Escaper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MageWorx\FixSecureRenderer\Model\Escaper
 */
class EscaperTest extends TestCase
{
    /**
     * @var Escaper
     */
    private Escaper $escaper;

    protected function setUp(): void
    {
        parent::setUp();
        $this->escaper = new Escaper();
    }

    /**
     * @dataProvider escapeDoubleQuotesDataProvider
     */
    public function testEscapeDoubleQuotes(string $input, string $expected): void
    {
        $this->assertSame($expected, $this->escaper->escapeDoubleQuotes($input));
    }

    /**
     * Provides test cases for escapeDoubleQuotes method.
     *
     * @return array
     */
    public function escapeDoubleQuotesDataProvider(): array
    {
        return [
            'Escapes unescaped double quotes' => [
                'input' => '#options_279_file input[type="checkbox"]',
                'expected' => '#options_279_file input[type=\"checkbox\"]',
            ],
            'Does not escape already escaped double quotes' => [
                'input' => '#options_279_file input[type=\"checkbox\"]',
                'expected' => '#options_279_file input[type=\"checkbox\"]',
            ],
            'Handles empty string' => [
                'input' => '',
                'expected' => '',
            ],
            'Handles string without double quotes' => [
                'input' => '#options_279_file input[type=checkbox]',
                'expected' => '#options_279_file input[type=checkbox]',
            ],
            'Handles multiple unescaped double quotes' => [
                'input' => '"input" "type" "checkbox"',
                'expected' => '\"input\" \"type\" \"checkbox\"',
            ],
            'Handles JSON string' => [
                'input' => '{"key": "value"}',
                'expected' => '{\"key\": \"value\"}',
            ],
            'Handles HTML with double quotes' => [
                'input' => '<input type="text" value="Hello">',
                'expected' => '<input type=\"text\" value=\"Hello\">',
            ],
            'Handles multiple occurrences of mixed quotes' => [
                'input' => 'She said, "Hello" and then "Bye".',
                'expected' => 'She said, \"Hello\" and then \"Bye\".',
            ],
            'Handles nested double quotes' => [
                'input' => '"Outer "inner" quotes"',
                'expected' => '\"Outer \"inner\" quotes\"',
            ],
            'Handles string with only double quotes' => [
                'input' => '""""',
                'expected' => '\"\"\"\"',
            ],
        ];
    }
}
