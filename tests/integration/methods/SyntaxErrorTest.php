<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\methods;

use openWebX\Rule\Rule;
use openWebX\Rule\tests\integration\AbstractTestBase;

class SyntaxErrorTest extends AbstractTestBase
{
    public function testMissingCommaInArgumentsThrowsException()
    {
        $rule = new Rule('"foo".charAt(1 2 ) === "b"');

        $this->assertFalse($rule->isValid());
        $this->assertSame('Unexpected "2" at position 15', $rule->getError());
    }

    public function testMissingValueInArgumentsThrowsException()
    {
        $rule = new Rule('"foo".charAt(1 , ) === "b"');

        $this->assertFalse($rule->isValid());
        $this->assertSame('Unexpected "," at position 17', $rule->getError());
    }

    public function testMissingValueBetweenCommasInArgumentsThrowsException()
    {
        $rule = new Rule('"foo".charAt(1 , , ) === "b"');

        $this->assertFalse($rule->isValid());
        $this->assertSame('Unexpected "," at position 17', $rule->getError());
    }

    public function testUnexpectedTokenInArgumentsThrowsException()
    {
        $rule = new Rule('"foo".charAt(1 , < , ) === "b"');

        $this->assertFalse($rule->isValid());
        $this->assertSame('Unexpected "<" at position 17', $rule->getError());
    }

    public function testUnexpectedEndOfStringThrowsException()
    {
        $rule = new Rule('"foo".charAt(1 , ');

        $this->assertFalse($rule->isValid());
        $this->assertSame('Unexpected end of string', $rule->getError());
    }

    public function testUndefinedMethodThrowsException()
    {
        $rule = new Rule('/^foo$/.teddst("foo") === true');

        $this->assertFalse($rule->isValid());
        $this->assertSame('Undefined method "teddst" at position 7', $rule->getError());
    }

    public function testIncorrectSpellingThrowsException()
    {
        $rule = new Rule('"foo".ChARat(1) === "o"');

        $this->assertFalse($rule->isValid());
        $this->assertSame('Undefined method "ChARat" at position 5', $rule->getError());
    }

    public function testCallOnNonArray()
    {
        $rule = new Rule('"foo".join("|") === ""');

        $this->assertFalse($rule->isValid());
        $this->assertSame('foo.join is not a function', $rule->getError());
    }

    public function testExceptionIsThrownOnTypeError()
    {
        $rule = new Rule('"foo".test("foo") === false');

        $this->assertFalse($rule->isValid());
        $this->assertSame('undefined is not a function', $rule->getError());
    }
}
