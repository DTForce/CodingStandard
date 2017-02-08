<?php

function abc(?string $a) : ?string {

}

function manyManyArguments(
	?int $a,
	string $b,
	?float $c
) : ?bool
{
	return 0;
}

function processIPNWithReasonCode(Message $message)
{
	if (true) {
		$transaction = null;

		// Update db.
		switch ($status) {
			case 'shit':
			case 0:
			case "some weird shit":
			case SOME_CONST:
			case SOME_NMSPC::SOME_CONST:
				break;

			default:
				break;
		}

	} else {
		$ipnProcessed = false;
	}
}


private function getById(string $id) : ?AEntity
{
	return $query->getQuery()->getOneOrNullResult();
}