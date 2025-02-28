<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Markdown\View\Directive;

use League\CommonMark\ConverterInterface;

/**
 * This is the markdown directive class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class MarkdownDirective
{
    /**
     * The markdown instance.
     *
     * @var \League\CommonMark\MarkdownConverterInterface
     */
    private $markdown;

    /**
     * Create a new markdown directive instance.
     *
     * @param \League\CommonMark\ConverterInterface $markdown
     *
     * @return void
     */
    public function __construct(ConverterInterface $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * Normalize and render the markdown.
     *
     * @param string $markdown
     *
     * @return string
     */
    public function render(string $markdown)
    {
        return $this->markdown->convert(self::adjust($markdown));
    }

    /**
     * Adjust for indentation.
     *
     * @param string $markdown
     *
     * @return string
     */
    private static function adjust(string $markdown)
    {
        $lines = preg_split("/(\r\n|\n|\r)/", $markdown);

        if (!$lines) {
            return $markdown;
        }

        $last = array_values(array_slice($lines, -1))[0];
        if ($indent = trim($last) === '' ? $last : '') {
            $len = strlen($indent);
            foreach ($lines as $key => $value) {
                if (substr($value, 0, $len) === $indent) {
                    $lines[$key] = substr($value, $len);
                } elseif (trim($value) !== '') {
                    return $markdown; // bail out
                }
            }
        }

        return implode("\n", $lines);
    }
}
