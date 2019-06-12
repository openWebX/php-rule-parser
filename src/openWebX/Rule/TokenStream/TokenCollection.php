<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\TokenStream;

use SplObjectStorage;

final class TokenCollection extends SplObjectStorage {
    /**
     * @return Token\BaseToken|null
     */
    public function current() {
        return parent::current();
    }

    public function toArray(): array {
        $items = [];

        foreach ($this as $item) {
            $items[] = $item->getValue();
        }

        return $items;
    }
}
