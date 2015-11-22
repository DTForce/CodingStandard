<?php

namespace DTForce\CodingStandard\Tests\Sniffs\Naming\AbstractClassName;

use DTForce\CodingStandard\Tests\CodeSnifferRunner;
use PHPUnit_Framework_TestCase;


/**
 * @covers DTForceCodingStandard\Sniffs\Naming\AbstractClassNameSniff
 */
final class AbstractClassNameSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('DTForceCodingStandard.Naming.AbstractClassName');

		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct2.php'));
		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
	}

}
