<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types = 1);

namespace MageWorx\FixSecureRenderer\Plugin;

/**
 * Ensure that double quotes in the $elementSelector are escaped.
 * Example string for escaping: #options_279_file input[type="checkbox"]
 * Must be: #options_279_file input[type=\"checkbox\"]
 */
class SecureHtmlRendererPlugin
{
    protected \MageWorx\FixSecureRenderer\Api\EscaperInterface $escaper;

    public function __construct(
        \MageWorx\FixSecureRenderer\Api\EscaperInterface $escaper
    ) {
        $this->escaper = $escaper;
    }

    /**
     * @param \Magento\Framework\View\Helper\SecureHtmlRenderer $subject
     * @param string $eventName
     * @param string $attributeJavascript
     * @param string $elementSelector
     * @return array
     */
    public function beforeRenderEventListenerAsTag(
        \Magento\Framework\View\Helper\SecureHtmlRenderer $subject,
        string                                            $eventName,
        string                                            $attributeJavascript,
        string                                            $elementSelector
    ): array {
        // Escape only if string contain double quotes
        if (strpos($elementSelector, '"') !== false) {
            $elementSelector = $this->escaper->escapeDoubleQuotes($elementSelector);
        }

        return [$eventName, $attributeJavascript, $elementSelector];
    }
}
