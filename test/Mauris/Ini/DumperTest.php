<?php
namespace Mauris\Ini;

class DumperTest extends \PHPUnit_Framework_TestCase
{
    public function testDump()
    {
        $dumper = new Dumper();
        $result = $dumper->dump(array('test' => array('value' => true)));

        $expected = <<<EOT
[test]
value=true


EOT;
        $this->assertEquals($expected, $result);
    }
}
