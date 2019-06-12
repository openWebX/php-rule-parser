<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\unit\Parser;

use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use openWebX\Rule\TokenStream\AST;
use openWebX\Rule\Compiler\CompilerFactoryInterface;
use openWebX\Rule\Compiler\CompilerInterface;
use openWebX\Rule\Expression\BaseExpression;
use openWebX\Rule\Expression\ExpressionFactoryInterface;
use openWebX\Rule\Parser\Parser;
use openWebX\Rule\TokenStream\Token;
use openWebX\Rule\TokenStream\TokenStream;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var AST|m\Mock */
    private $ast;
    /** @var ExpressionFactoryInterface|m\Mock */
    private $expressionFactory;
    /** @var CompilerFactoryInterface|m\Mock */
    private $compilerFactory;
    /** @var Parser */
    private $parser;

    protected function setUp()
    {
        $this->ast = m::mock(AST::class);
        $this->expressionFactory = m::mock(ExpressionFactoryInterface::class);
        $this->compilerFactory = m::mock(CompilerFactoryInterface::class);

        $this->parser = new Parser($this->ast, $this->expressionFactory, $this->compilerFactory);
    }

    /** @test */
    public function givenARuleStringWhenValidItShouldReturnTheCompiledRule()
    {
        $tokens = [
            new Token\TokenOpeningParenthesis('('),
            new Token\TokenInteger(1),
            new Token\TokenEqual('=='),
            new Token\TokenString('1'),
            new Token\TokenClosingParenthesis(')'),
            new Token\TokenAnd('&&'),
            new Token\TokenInteger(2),
            new Token\TokenGreater('>'),
            new Token\TokenInteger(1),
            new Token\TokenSpace(' '),
            new Token\TokenComment('// true dat!')
        ];

        $compiler = m::mock(CompilerInterface::class);
        $compiler->shouldReceive('addLogical')->once();
        $compiler->shouldReceive('addParentheses')->twice();
        $compiler->shouldReceive('addBoolean')->twice();
        $compiler->shouldReceive('getCompiledRule')->once()->andReturn('(1)&1');

        /** @var m\MockInterface $tokenStream */
        $tokenStream = \Mockery::mock(TokenStream::class);
        $tokenStream->shouldReceive('rewind')->once();
        $tokenStream->shouldReceive('next');
        $tokenStream->shouldReceive('current')->andReturn(...$tokens);
        $tokenStream->shouldReceive('valid')->andReturnUsing(function () use (&$tokens) {
            return !!next($tokens);
        });

        $this->compilerFactory->shouldReceive('create')->once()->andReturn($compiler);
        $this->ast->shouldReceive('getStream')->once()->andReturn($tokenStream);

        $equalExpression = m::mock(BaseExpression::class);
        $equalExpression->shouldReceive('evaluate')->once()->with(1, '1');

        $greaterExpression = m::mock(BaseExpression::class);
        $greaterExpression->shouldReceive('evaluate')->once()->with(2, 1);

        $this->expressionFactory
            ->shouldReceive('createFromOperator')
            ->twice()
            ->with(m::type(Token\BaseToken::class))
            ->andReturn(
                $equalExpression,
                $greaterExpression
            );

        $this->assertSame('(1)&1', $this->parser->parse('(1=="1")&&2>1 // true dat!'));
    }
}
