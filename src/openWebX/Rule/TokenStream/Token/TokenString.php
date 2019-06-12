<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream\Token;

use openWebX\Rule\TokenStream\Node\NodeString;
use openWebX\Rule\TokenStream\TokenStream;

class TokenString extends BaseToken {
    public function getType(): int {
        return TokenType::VALUE;
    }

    public function createNode(TokenStream $tokenStream): BaseToken {
        return (new NodeString($tokenStream))->getNode();
    }
}
