<?php

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Compiler;

use openWebX\Rule\TokenStream\Token\BaseToken;

interface CompilerInterface {
    public function getCompiledRule(): string;

    public function addParentheses(BaseToken $token);

    public function addLogical(BaseToken $token);

    public function addBoolean(bool $bool);
}
