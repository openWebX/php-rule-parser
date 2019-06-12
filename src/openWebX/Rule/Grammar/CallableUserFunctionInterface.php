<?php

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Grammar;

use openWebX\Rule\TokenStream\Token\BaseToken;

interface CallableUserFunctionInterface {
    public function call(BaseToken $param = null): BaseToken;
}
