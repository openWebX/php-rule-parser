<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\unit\Evaluator;

use openWebX\Rule\Evaluator\Evaluator;
use openWebX\Rule\Evaluator\Exception\UnknownSymbolException;
use PHPUnit\Framework\TestCase;

class EvaluatorTest extends TestCase
{
    /** @var Evaluator */
    private $evaluator;

    protected function setUp()
    {
        $this->evaluator = new Evaluator();
    }

    /** @test */
    public function givenACompiledRuleWithAnLogicalAndItShouldEvaluateBothOperandsAndReturnTheResult()
    {
        $this->assertTrue($this->evaluator->evaluate('1&1'));
        $this->assertFalse($this->evaluator->evaluate('1&0'));
        $this->assertFalse($this->evaluator->evaluate('0&1'));
        $this->assertFalse($this->evaluator->evaluate('0&0'));
    }

    /** @test */
    public function givenACompiledRuleWithAnLogicalOrItShouldEvaluateBothOperandsAndReturnTheResult()
    {
        $this->assertTrue($this->evaluator->evaluate('1|1'));
        $this->assertTrue($this->evaluator->evaluate('1|0'));
        $this->assertTrue($this->evaluator->evaluate('0|1'));
        $this->assertFalse($this->evaluator->evaluate('0|0'));
    }

    /** @test */
    public function givenACompiledRuleWithGroupsTheyShouldBeEvaluatedFirst()
    {
        $this->assertTrue($this->evaluator->evaluate('0|(1|0)'));
        $this->assertTrue($this->evaluator->evaluate('1|(0|0)'));
        $this->assertTrue($this->evaluator->evaluate('0|(0|(0|1))'));
        $this->assertFalse($this->evaluator->evaluate('0|(0|(0|0))'));
        $this->assertFalse($this->evaluator->evaluate('0|(0|(1&0))'));
    }

    /** @test */
    public function givenACharacterWhenUnknownItShouldThrowAnException()
    {
        $this->expectException(UnknownSymbolException::class);
        $this->expectExceptionMessage('Unexpected "3"');

        $this->evaluator->evaluate('3|1');
    }
}
