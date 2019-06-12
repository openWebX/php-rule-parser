<?php

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Compiler\Exception;

use Exception;

class MissingOperatorException extends Exception {
    protected $message = 'Missing operator';
}
