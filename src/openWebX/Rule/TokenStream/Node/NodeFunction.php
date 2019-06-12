<?php declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream\Node;

use openWebX\Rule\TokenStream\Token\BaseToken;

final class NodeFunction extends BaseNode {
    public function getNode(): BaseToken {
        return $this->getFunction()->call($this, ...$this->getArguments());
    }
}
