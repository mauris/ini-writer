<?php
namespace Mauris\Ini;

class DumperTest extends \PHPUnit_Framework_TestCase
{
    public function testDump()
    {
        $dumper = new Dumper();
        $result = $dumper->dump(array('test' => array('value' => true, 'five' => 5, 'str' => 'i"m a boy')));

        $expected = <<<EOT
[test]
value=true
five=5
str="i\"m a boy"

EOT;
        $this->assertEquals($expected, $result);
    }
}
