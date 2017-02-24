<?php

namespace SomeNamespace;


class SomeClass
{

	public function getSummary() : ?string
	{
	}

	/**
	 * @return string
	 */
	public function getSome()
	{
		return 'some';
	}


	public function getXY() : float
	{
	}

	public function getList() : array
	{
	}

	function barInterface(?array $a) : ?array;

	public function getTransactions() : array
	{
		return $this->xy->toArray();
	}

}
