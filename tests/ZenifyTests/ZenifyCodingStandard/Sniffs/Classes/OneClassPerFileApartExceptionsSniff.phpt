<?php

namespace ZenifyTests\ZenifyCodingStandard\Sniffs\Classes;

use Tester\Assert;
use ZenifyTests\TestCase;


require_once __DIR__ . '/../../../bootstrap.php';


class OneClassPerFileApartExceptionsSniffTest extends TestCase
{

	public function testWrong()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/OneClassPerFileApartExceptions.wrong.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Each class must be standalone file, apart exception classes',
			'ZenifyCodingStandard.Classes.OneClassPerFileApartExceptions'
		);

		$result = $this->runPhpCsForFile(__DIR__ . '/OneClassPerFileApartExceptions.wrong2.php');
		Assert::count(1, $result['errors']);
		$this->validateErrorMessageAndSource(
			$result['errors'][0],
			'Each class must be standalone file, apart exception classes',
			'ZenifyCodingStandard.Classes.OneClassPerFileApartExceptions'
		);
	}


	public function testCorrect()
	{
		$result = $this->runPhpCsForFile(__DIR__ . '/OneClassPerFileApartExceptions.correct.php');
		Assert::count(0, $result['errors']);
	}

}


run(new OneClassPerFileApartExceptionsSniffTest);