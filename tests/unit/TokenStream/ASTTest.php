<?php declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\unit\TokenStream;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use openWebX\Rule\Grammar\CallableUserFunctionInterface;
use openWebX\Rule\Grammar\Grammar;
use openWebX\Rule\Tokenizer\TokenizerInterface;
use openWebX\Rule\TokenStream\AST;
use openWebX\Rule\TokenStream\Exception\UndefinedFunctionException;
use openWebX\Rule\TokenStream\Node\BaseNode;
use openWebX\Rule\TokenStream\Token\BaseToken;
use openWebX\Rule\TokenStream\Token\TokenFactory;
use openWebX\Rule\TokenStream\TokenStreamFactory;
use PHPUnit\Framework\TestCase;

class ASTTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var TokenizerInterface|MockInterface */
    private $tokenizer;
    /** @var TokenFactory|MockInterface */
    private $tokenFactory;
    /** @var TokenStreamFactory|MockInterface */
    private $tokenStreamFactory;
    /** @var AST */
    private $ast;

    protected function setUp()
    {
        $this->tokenizer = \Mockery::mock(TokenizerInterface::class);
        $this->tokenFactory = \Mockery::mock(TokenFactory::class);
        $this->tokenStreamFactory = \Mockery::mock(TokenStreamFactory::class);
        $this->ast = new AST($this->tokenizer, $this->tokenFactory, $this->tokenStreamFactory);
    }

    public function testGivenAFunctionNameWhenValidItShouldReturnTheCorrespondingFunction()
    {
        $grammar = \Mockery::mock(Grammar::class);
        $grammar->shouldReceive('getInternalFunctions')->once()->andReturn(['test' => TestFunc::class]);
        $this->tokenizer->shouldReceive('getGrammar')->once()->andReturn($grammar);

        /** @var BaseToken $result */
        $result = $this->ast->getFunction('test')->call(\Mockery::mock(BaseNode::class));

        $this->assertSame(234, $result->getValue());
    }

    public function testGivenAFunctionNameWhenItDoesNotImplementTheInterfaceItShouldThrowAnException()
    {
        $this->expectExceptionMessage(sprintf(
            'stdClass must be an instance of %s',
            CallableUserFunctionInterface::class
        ));

        $grammar = \Mockery::mock(Grammar::class);
        $grammar->shouldReceive('getInternalFunctions')->once()->andReturn(['test' => \stdClass::class]);
        $this->tokenizer->shouldReceive('getGrammar')->once()->andReturn($grammar);

        $this->ast->getFunction('test')->call(\Mockery::mock(BaseNode::class));
    }

    public function testGivenAFunctionNameNotDefinedItShouldThrowAnException()
    {
        $this->expectException(UndefinedFunctionException::class);
        $this->expectExceptionMessage('pineapple_pizza');

        $grammar = \Mockery::mock(Grammar::class);
        $grammar->shouldReceive('getInternalFunctions')->once()->andReturn([]);
        $this->tokenizer->shouldReceive('getGrammar')->once()->andReturn($grammar);

        $this->ast->getFunction('pineapple_pizza')->call(\Mockery::mock(BaseNode::class));
    }
}
