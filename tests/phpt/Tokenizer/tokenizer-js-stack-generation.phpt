--TEST--
Tokenizer stack generation with JavaScript grammar
--FILE--
<?php

use openWebX\Rule\Tokenizer\Tokenizer;
use openWebX\Rule\Grammar\JavaScript\JavaScript;
use openWebX\Rule\TokenStream\Token\TokenFactory;

require_once __DIR__ . '/../../../vendor/autoload.php';

$tokenizer = new Tokenizer(new JavaScript(), new TokenFactory());

$rule = 'parseInt("2") == var_two && ("foo".toUpperCase() === "FOO") || 1 in ["1", 2, var_one]';

var_dump($tokenizer->tokenize($rule));

?>
--EXPECTF--
object(ArrayIterator)#%d (1) {
  ["storage":"ArrayIterator":private]=>
  array(35) {
    [0]=>
    object(openWebX\Rule\TokenStream\Token\TokenFunction)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(9) "parseInt("
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(0)
    }
    [1]=>
    object(openWebX\Rule\TokenStream\Token\TokenEncapsedString)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(3) ""2""
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(9)
    }
    [2]=>
    object(openWebX\Rule\TokenStream\Token\TokenClosingParenthesis)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) ")"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(12)
    }
    [3]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(13)
    }
    [4]=>
    object(openWebX\Rule\TokenStream\Token\TokenEqual)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(2) "=="
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(14)
    }
    [5]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(16)
    }
    [6]=>
    object(openWebX\Rule\TokenStream\Token\TokenVariable)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(7) "var_two"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(17)
    }
    [7]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(24)
    }
    [8]=>
    object(openWebX\Rule\TokenStream\Token\TokenAnd)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(2) "&&"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(25)
    }
    [9]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(27)
    }
    [10]=>
    object(openWebX\Rule\TokenStream\Token\TokenOpeningParenthesis)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) "("
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(28)
    }
    [11]=>
    object(openWebX\Rule\TokenStream\Token\TokenEncapsedString)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(5) ""foo""
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(29)
    }
    [12]=>
    object(openWebX\Rule\TokenStream\Token\TokenMethod)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(13) ".toUpperCase("
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(34)
    }
    [13]=>
    object(openWebX\Rule\TokenStream\Token\TokenClosingParenthesis)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) ")"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(47)
    }
    [14]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(48)
    }
    [15]=>
    object(openWebX\Rule\TokenStream\Token\TokenEqualStrict)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(3) "==="
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(49)
    }
    [16]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(52)
    }
    [17]=>
    object(openWebX\Rule\TokenStream\Token\TokenEncapsedString)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(5) ""FOO""
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(53)
    }
    [18]=>
    object(openWebX\Rule\TokenStream\Token\TokenClosingParenthesis)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) ")"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(58)
    }
    [19]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(59)
    }
    [20]=>
    object(openWebX\Rule\TokenStream\Token\TokenOr)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(2) "||"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(60)
    }
    [21]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(62)
    }
    [22]=>
    object(openWebX\Rule\TokenStream\Token\TokenInteger)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) "1"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(63)
    }
    [23]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(64)
    }
    [24]=>
    object(openWebX\Rule\TokenStream\Token\TokenIn)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(2) "in"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(65)
    }
    [25]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(67)
    }
    [26]=>
    object(openWebX\Rule\TokenStream\Token\TokenOpeningArray)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) "["
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(68)
    }
    [27]=>
    object(openWebX\Rule\TokenStream\Token\TokenEncapsedString)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(3) ""1""
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(69)
    }
    [28]=>
    object(openWebX\Rule\TokenStream\Token\TokenComma)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) ","
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(72)
    }
    [29]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(73)
    }
    [30]=>
    object(openWebX\Rule\TokenStream\Token\TokenInteger)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) "2"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(74)
    }
    [31]=>
    object(openWebX\Rule\TokenStream\Token\TokenComma)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) ","
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(75)
    }
    [32]=>
    object(openWebX\Rule\TokenStream\Token\TokenSpace)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) " "
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(76)
    }
    [33]=>
    object(openWebX\Rule\TokenStream\Token\TokenVariable)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(7) "var_one"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(77)
    }
    [34]=>
    object(openWebX\Rule\TokenStream\Token\TokenClosingArray)#%d (2) {
      ["value":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      string(1) "]"
      ["offset":"openWebX\Rule\TokenStream\Token\BaseToken":private]=>
      int(84)
    }
  }
}
