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

namespace GrahamCampbell\Markdown\View\Engine;

use Illuminate\View\Engines\PhpEngine;
use League\CommonMark\ConverterInterface;

/**
 * This is the php markdown engine class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
final class PhpMarkdownEngine extends PhpEngine
{
    use PathEvaluationTrait;

    /**
     * The markdown instance.
     *
     * @var \League\CommonMark\MarkdownConverterInterface
     */
    private $markdown;

    /**
     * Create a new instance.
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
     * Get the evaluated contents of the view.
     *
     * @param string $path
     * @param array  $data
     *
     * @return string
     */
    public function get($path, array $data = [])
    {
        $contents = parent::get($path, $data);

        return $this->markdown->convert($contents);
    }

    /**
     * Return the markdown instance.
     *
     * @return \League\CommonMark\ConverterInterface
     */
    public function getMarkdown()
    {
        return $this->markdown;
    }
}
