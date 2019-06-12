<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\methods;

use openWebX\Rule\tests\integration\AbstractTestBase;

class JoinTest extends AbstractTestBase
{
    protected $array = ['foo' => ['foo', 'bar']];

    public function testIfOmittedDelimiterFallsBackToDefault()
    {
        $this->assertTrue($this->evaluate('foo.join() === "foo,bar"', $this->array));
    }

    public function testLiteralStringDelimiter()
    {
        $this->assertTrue($this->evaluate('foo.join("|") === "foo|bar"', $this->array));
    }

    public function testVariableValueAsDelimiter()
    {
        $this->assertTrue($this->evaluate(
            'foo.join(separator) === "foo$bar"',
            $this->array + ['separator' => '$']
        ));
    }

    public function testCallOnStringLiteralArray()
    {
        $this->assertTrue($this->evaluate('[1, 2, 3].join("|") === "1|2|3"'));
        $this->assertTrue($this->evaluate('[1, 2, 3] . join("|") === "1|2|3"'));
    }

    public function testVariableInArrayIsJoined()
    {
        $this->assertTrue($this->evaluate('[1, 2, foo].join("|") === "1|2|3"', ['foo' => 3]));
    }

    public function testJoinOnEmptyArray()
    {
        $this->assertTrue($this->evaluate('[].join("|") === ""'));
    }
}
