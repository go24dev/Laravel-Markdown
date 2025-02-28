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

namespace GrahamCampbell\Tests\Markdown;

use GrahamCampbell\Markdown\View\Compiler\MarkdownCompiler;
use GrahamCampbell\Markdown\View\Directive\MarkdownDirective;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Environment\EnvironmentInterface;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testEnvironmentIsInjectable()
    {
        $this->assertIsInjectable(Environment::class);
        $this->assertIsInjectable(EnvironmentInterface::class);
        $this->assertIsInjectable(ConverterInterface::class);
    }

    public function testMarkdownIsInjectable()
    {
        $this->assertIsInjectable(CommonMarkConverter::class);
        $this->assertIsInjectable(ConverterInterface::class);
    }

    public function testCompilerIsInjectable()
    {
        $this->assertIsInjectable(MarkdownCompiler::class);
    }

    public function testDirectiveIsInjectable()
    {
        $this->assertIsInjectable(MarkdownDirective::class);
    }
}
