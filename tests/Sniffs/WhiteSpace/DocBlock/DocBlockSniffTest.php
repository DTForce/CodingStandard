<?php

namespace DTForce\CodingStandard\Tests\Sniffs\WhiteSpace\DocBlock;

use DTForce\CodingStandard\Tests\CodeSnifferRunner;
use PHPUnit_Framework_TestCase;


/**
 * @covers DTForceCodingStandard\Sniffs\WhiteSpace\DocBlockSniff
 */
final class DocBlockSniffTest extends PHPUnit_Framework_TestCase
{

	public function testDetection()
	{
		$codeSnifferRunner = new CodeSnifferRunner('DTForceCodingStandard.WhiteSpace.DocBlock');

		$this->assertSame(4, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
	}


	public function testIdentationInside()
	{
		$codeSnifferRunner = new CodeSnifferRunner('DTForceCodingStandard.WhiteSpace.DocBlock');

		$this->assertSame(2, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong-inside.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct-inside.php'));
	}


	public function testIdentationInside2()
	{
		$codeSnifferRunner = new CodeSnifferRunner('DTForceCodingStandard.WhiteSpace.DocBlock');

		$this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong-inside2.php'));
		$this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct-inside2.php'));
	}

}
