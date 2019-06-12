<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\integration;

use openWebX\Rule\Rule;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestBase extends TestCase
{
    protected function evaluate(string $rule, array $variables = []): bool
    {
        return (new Rule($rule, $variables))->isTrue();
    }
}
