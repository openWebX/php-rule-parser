<?php

declare(strict_types=1);

/**
 * @license     http://opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/openWebX
 * @author      Nicolas Oelgart <nico@oelgart.com>
 */

namespace openWebX\Rule\Compiler;

class CompilerFactory implements CompilerFactoryInterface {
    public function create(): CompilerInterface {
        return new StandardCompiler();
    }
}
