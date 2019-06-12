<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Compiler;

use openWebX\Rule\Compiler\Exception\MissingOperatorException;
use openWebX\Rule\Parser\Exception\ParserException;
use openWebX\Rule\TokenStream\Token\BaseToken;
use openWebX\Rule\TokenStream\Token\TokenAnd;
use openWebX\Rule\TokenStream\Token\TokenOpeningParenthesis;

class StandardCompiler implements CompilerInterface {
    const BOOL_TRUE = '1';
    const BOOL_FALSE = '0';

    const LOGICAL_AND = '&';
    const LOGICAL_OR = '|';

    const OPENING_PARENTHESIS = '(';
    const CLOSING_PARENTHESIS = ')';

    private $output = '';
    private $openParenthesis = 0;
    private $closedParenthesis = 0;

    public function getCompiledRule(): string {
        if ($this->isIncompleteCondition()) {
            throw new ParserException('Incomplete condition');
        } elseif (!$this->numParenthesesMatch()) {
            throw new ParserException('Missing closing parenthesis');
        }

        return $this->output;
    }

    private function isIncompleteCondition(): bool {
        $lastChar = $this->getLastChar();

        return (
            $lastChar === self::LOGICAL_AND ||
            $lastChar === self::LOGICAL_OR
        );
    }

    private function getLastChar(): string {
        return substr($this->output, -1);
    }

    private function numParenthesesMatch(): bool {
        return $this->openParenthesis === $this->closedParenthesis;
    }

    public function addParentheses(BaseToken $token) {
        if ($token instanceof TokenOpeningParenthesis) {
            if (!$this->expectOpeningParenthesis()) {
                throw ParserException::unexpectedToken($token);
            }
            $this->openParenthesis();
        } else {
            $this->closeParenthesis();
        }
    }

    private function expectOpeningParenthesis(): bool {
        $lastChar = $this->getLastChar();

        return (
            $lastChar === '' ||
            $lastChar === self::LOGICAL_AND ||
            $lastChar === self::LOGICAL_OR ||
            $lastChar === self::OPENING_PARENTHESIS
        );
    }

    private function openParenthesis() {
        $this->openParenthesis++;
        $this->output .= self::OPENING_PARENTHESIS;
    }

    private function closeParenthesis() {
        if ($this->openParenthesis < 1) {
            throw new ParserException('Missing opening parenthesis');
        }

        $this->closedParenthesis++;
        $this->output .= self::CLOSING_PARENTHESIS;
    }

    public function addLogical(BaseToken $token) {
        $lastChar = $this->getLastChar();

        if ($lastChar === self::LOGICAL_AND || $lastChar === self::LOGICAL_OR) {
            throw ParserException::unexpectedToken($token);
        }

        if ($token instanceof TokenAnd) {
            $this->output .= self::LOGICAL_AND;
        } else {
            $this->output .= self::LOGICAL_OR;
        }
    }

    public function addBoolean(bool $bool) {
        $lastChar = $this->getLastChar();

        if ($lastChar === self::BOOL_TRUE || $lastChar === self::BOOL_FALSE) {
            throw new MissingOperatorException();
        }

        $this->output .= $bool ? self::BOOL_TRUE : self::BOOL_FALSE;
    }
}
