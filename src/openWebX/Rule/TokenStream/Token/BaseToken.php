<?php declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream\Token;

use openWebX\Rule\TokenStream\TokenStream;

abstract class BaseToken {
    /** @var mixed */
    private $value;
    /** @var int */
    private $offset = 0;

    public function __construct($value, int $offset = 0) {
        $this->value = $value;
        $this->offset = $offset;
    }

    public function getValue() {
        return $this->value;
    }

    final public function getOriginalValue() {
        return $this->value;
    }

    public function getOffset(): int {
        return $this->offset;
    }

    public function createNode(TokenStream $tokenStream): self {
        return $this;
    }

    public function isValue(): bool {
        return $this->isOfType(TokenType::VALUE | TokenType::INT_VALUE);
    }

    public function isOfType(int $type): bool {
        return ($this->getType() | $type) === $type;
    }

    abstract public function getType(): int;

    public function isWhitespace(): bool {
        return $this->isOfType(TokenType::SPACE | TokenType::COMMENT);
    }

    public function isMethod(): bool {
        return $this->isOfType(TokenType::METHOD);
    }

    public function isComma(): bool {
        return $this->isOfType(TokenType::COMMA);
    }

    public function isOperator(): bool {
        return $this->isOfType(TokenType::OPERATOR);
    }

    public function isLogical(): bool {
        return $this->isOfType(TokenType::LOGICAL);
    }

    public function isParenthesis(): bool {
        return $this->isOfType(TokenType::PARENTHESIS);
    }
}
