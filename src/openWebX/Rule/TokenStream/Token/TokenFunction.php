<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream\Token;

use openWebX\Rule\TokenStream\Node\NodeFunction;
use openWebX\Rule\TokenStream\TokenStream;

final class TokenFunction extends BaseToken {
    public function getType(): int {
        return TokenType::FUNCTION;
    }

    public function createNode(TokenStream $tokenStream): BaseToken {
        return (new NodeFunction($tokenStream))->getNode();
    }
}
