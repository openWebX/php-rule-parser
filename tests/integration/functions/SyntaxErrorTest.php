<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\functions;

use openWebX\Rule\Rule;
use openWebX\Rule\tests\integration\AbstractTestBase;

class SyntaxErrorTest extends AbstractTestBase
{
    public function testUndefinedFunctionThrowsException()
    {
        $rule = new Rule('nope() === true');

        $this->assertFalse($rule->isValid());
        $this->assertSame('nope is not defined at position 0', $rule->getError());
    }

    public function testIncorrectSpellingThrowsException()
    {
        $rule = new Rule('/* fail */ paRSeInt("2") === 2');

        $this->assertFalse($rule->isValid());
        $this->assertSame('paRSeInt is not defined at position 11', $rule->getError());
    }
}
