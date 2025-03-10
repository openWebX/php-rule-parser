<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\unit\Expression;

use openWebX\Rule\Expression;
use openWebX\Rule\Expression\ExpressionFactory;
use openWebX\Rule\TokenStream\Token;
use PHPUnit\Framework\TestCase;

class ExpressionFactoryTest extends TestCase
{
    /** @var ExpressionFactory */
    private $factory;

    protected function setUp()
    {
        $this->factory = new ExpressionFactory();
    }

    /**
     * @test
     * @dataProvider expressionProvider
     */
    public function givenAnEqualOperatorItShouldCreateAnEqualExpression(string $expressionClass, Token\BaseToken $token)
    {
        $this->assertInstanceOf(
            $expressionClass,
            $this->factory->createFromOperator($token)
        );
    }

    public function expressionProvider(): array
    {
        return [
            [Expression\EqualExpression::class, new Token\TokenEqual('==')],
            [Expression\EqualStrictExpression::class, new Token\TokenEqualStrict('===')],
            [Expression\NotEqualExpression::class, new Token\TokenNotEqual('!=')],
            [Expression\NotEqualStrictExpression::class, new Token\TokenNotEqualStrict('!==')],
            [Expression\GreaterThanExpression::class, new Token\TokenGreater('>')],
            [Expression\LessThanExpression::class, new Token\TokenSmaller('<')],
            [Expression\LessThanEqualExpression::class, new Token\TokenSmallerEqual('<=')],
            [Expression\GreaterThanEqualExpression::class, new Token\TokenGreaterEqual('>=')],
            [Expression\InExpression::class, new Token\TokenIn('in')],
        ];
    }
}
