<?php
declare(strict_types = 1);

use Exception\ArrayKeysMustBeSequentialException;
use Exception\ArrayMustConsistOnlyIntException;
use Exception\ArrayTooLargeException;

class Solver implements SolverInterface
{
    protected $n;
    protected $array;

    /**
     * @param array [int] $array
     * @throws ArrayKeysMustBeSequentialException
     * @throws ArrayTooLargeException
     * @throws ArrayMustConsistOnlyIntException
     * @return int
     */
    public function solve(array $array): int
    {
        $this->array = $array;
        $this->n = count($array);
        $this->throwExceptionIfArrayKeyIsNotSequential();
        $this->throwExceptionIfArrayTooLarge();
        $this->throwExceptionIfArrayInvalid();

        return $this->calculateEquilibrium();
    }

    /**
     * @throws ArrayKeysMustBeSequentialException
     */
    protected function throwExceptionIfArrayKeyIsNotSequential()
    {
        if (array_keys($this->array) !== range(0, count($this->array) - 1)) {
            throw new ArrayKeysMustBeSequentialException();
        }
    }

    /**
     * @throws ArrayTooLargeException
     */
    protected function throwExceptionIfArrayTooLarge()
    {
        if ($this->n > 100000) {
            throw new ArrayTooLargeException();
        }
    }

    /**
     * @throws ArrayMustConsistOnlyIntException
     */
    protected function throwExceptionIfArrayInvalid()
    {
        foreach ($this->array as $i) {
            if (!is_int($i) || !filter_var($i, FILTER_VALIDATE_INT,
                    ['options' =>
                        [
                            'min_range' => -2147483648,
                            'max_range' => 2147483647
                        ]
                    ])
            ) {
                throw new ArrayMustConsistOnlyIntException();
            }
        }
    }

    /**
     * @return int
     */
    protected function calculateEquilibrium(): int
    {
        $leftSum = 0;
        $rightSum = array_sum($this->array);
        for ($i = 0; $i < $this->n; $i++) {
            $rightSum -= $this->array[$i];
            if ($leftSum === $rightSum) {
                return $i;
            }
            $leftSum += $this->array[$i];
        }

        return -1;
    }
}
