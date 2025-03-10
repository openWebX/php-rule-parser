<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream\Token;

use openWebX\Rule\TokenStream\Node\NodeVariable;
use openWebX\Rule\TokenStream\TokenStream;

final class TokenVariable extends BaseToken {
    public function getType(): int {
        return TokenType::VARIABLE;
    }

    public function createNode(TokenStream $tokenStream): BaseToken {
        return (new NodeVariable($tokenStream))->getNode();
    }
}
