<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream\Node;

use openWebX\Rule\TokenStream\Token\BaseToken;

final class NodeString extends BaseNode {
    public function getNode(): BaseToken {
        $token = $this->getCurrentNode();

        while ($this->hasMethodCall()) {
            $token = $this->getMethod($token)->call(...$this->getArguments());
        }

        return $token;
    }
}
