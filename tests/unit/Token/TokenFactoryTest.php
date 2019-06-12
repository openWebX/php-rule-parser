<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */
namespace openWebX\Rule\tests\unit\Token;

use InvalidArgumentException;
use openWebX\Rule\Parser\Exception\ParserException;
use openWebX\Rule\TokenStream\Token;
use openWebX\Rule\TokenStream\Token\TokenEqualStrict;
use PHPUnit\Framework\TestCase;

class TokenFactoryTest extends TestCase
{
    /** @var Token\TokenFactory */
    private $tokenFactory;

    protected function setUp()
    {
        $this->tokenFactory = new Token\TokenFactory();
    }

    public function testSimpleTypeReturnsCorrectInstance()
    {
        $this->assertInstanceOf(Token\TokenNull::class, $this->tokenFactory->createFromPHPType(null));
        $this->assertInstanceOf(Token\TokenString::class, $this->tokenFactory->createFromPHPType('string sample'));
        $this->assertInstanceOf(Token\TokenFloat::class, $this->tokenFactory->createFromPHPType(0.3));
        $this->assertInstanceOf(Token\TokenInteger::class, $this->tokenFactory->createFromPHPType(4));
        $this->assertInstanceOf(Token\TokenBool::class, $this->tokenFactory->createFromPHPType(true));
        $this->assertInstanceOf(Token\TokenArray::class, $this->tokenFactory->createFromPHPType([1, 2]));
    }

    public function testUnsupportedTypeThrowsException()
    {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage('Unsupported PHP type: "object"');

        $this->tokenFactory->createFromPHPType(new \stdClass());
    }

    public function testGivenAnInvalidTokenNameItShouldThrowAnException()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->tokenFactory->createFromTokenName('betrunken');
    }

    public function testGivenAValidTokenNameItShouldReturnItsCorrespondingClassName()
    {
        $this->assertSame(TokenEqualStrict::class, $this->tokenFactory->createFromTokenName(Token\Token::EQUAL_STRICT));
    }
}
