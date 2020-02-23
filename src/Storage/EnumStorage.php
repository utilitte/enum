<?php declare(strict_types = 1);

namespace Warengo\Enum\Storage;

use Warengo\Enum\Enum;
use Warengo\Enum\Exceptions\InvalidArgumentException;
use Warengo\Enum\Exceptions\UnexpectedValueException;

class EnumStorage
{

	/** @var Enum[] */
	private $storage = [];

	private string $class;

	public function __construct(string $class)
	{
		$this->class = $class;
	}

	public function has(string $name): bool
	{
		return isset($this->storage[$name]);
	}

	public function get(string $name): Enum
	{
		if (!isset($this->storage[$name])) {
			throw new InvalidArgumentException(sprintf('%s not exists in enum storage', $name));
		}

		return $this->storage[$name];
	}

	public function set(string $name, Enum $enum): void
	{
		if (!$enum instanceof $this->class) {
			throw new UnexpectedValueException(
				sprintf('Value must be instance of %s, %s given', $this->class, get_class($enum))
			);
		}

		$this->storage[$name] = $enum;
	}

}
