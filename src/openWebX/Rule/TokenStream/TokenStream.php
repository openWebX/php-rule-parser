<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream;

use ArrayIterator;
use Closure;
use openWebX\Rule\Grammar\CallableUserFunctionInterface;
use openWebX\Rule\Parser\Exception\ParserException;
use openWebX\Rule\TokenStream\Token\BaseToken;

class TokenStream extends ArrayIterator {
    /** @var ArrayIterator */
    private $stack;
    /** @var AST */
    private $ast;

    public function __construct(ArrayIterator $stack, AST $ast) {
        $this->stack = $stack;
        $this->ast = $ast;
    }

    public function next() {
        $this->stack->next();
    }

    public function valid(): bool {
        return $this->stack->valid();
    }

    public function current(): BaseToken {
        return $this->getCurrentToken()->createNode($this);
    }

    private function getCurrentToken(): BaseToken {
        return $this->stack->current();
    }

    public function key(): int {
        return $this->stack->key();
    }

    public function rewind() {
        $this->stack->rewind();
    }

    public function getStack(): ArrayIterator {
        return $this->stack;
    }

    public function getVariable(string $variableName): BaseToken {
        try {
            return $this->ast->getVariable($variableName);
        } catch (Exception\UndefinedVariableException $e) {
            throw ParserException::undefinedVariable($variableName, $this->getCurrentToken());
        }
    }

    public function getFunction(string $functionName): Closure {
        try {
            return $this->ast->getFunction($functionName);
        } catch (Exception\UndefinedFunctionException $e) {
            throw ParserException::undefinedFunction($functionName, $this->getCurrentToken());
        }
    }

    public function getMethod(string $methodName, BaseToken $token): CallableUserFunctionInterface {
        try {
            return $this->ast->getMethod($methodName, $token);
        } catch (Exception\UndefinedMethodException $e) {
            throw ParserException::undefinedMethod($methodName, $this->getCurrentToken());
        }
    }
}
