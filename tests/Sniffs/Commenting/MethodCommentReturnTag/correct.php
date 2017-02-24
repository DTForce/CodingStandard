<?php

namespace SomeNamespace;


class SomeClass
{

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

	public function getTransactions() : array
	{
		return $this->xy->toArray();
	}

}
