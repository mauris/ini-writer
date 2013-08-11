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

    public function testDumpSubsections()
    {
        $data = array(
            'main' => array(
                'explore' => true,
                'sub'=> array(
                    'sub' => array(
                        'value' => 5
                    )
                )
            )
        );

        $dumper = new Dumper();
        $result = $dumper->dump($data);

        $expected = <<<EOT
[main]
explore=true

[main.sub]

[main.sub.sub]
value=5

EOT;
        $this->assertEquals($expected, $result);
    }
}
