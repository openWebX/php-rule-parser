<?php

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Tokenizer;

use ArrayIterator;
use openWebX\Rule\Grammar\Grammar;

interface TokenizerInterface {
    public function tokenize(string $string): ArrayIterator;

    public function getGrammar(): Grammar;
}
