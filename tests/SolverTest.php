<?php
declare(strict_types = 1);

namespace Tests;

use Exception\ArrayKeysMustBeSequentialException;
use Exception\ArrayMustConsistOnlyIntException;
use Exception\ArrayTooLargeException;

class SolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [[-1, 3, -4, 5, 1, -6, 2, 1], [1, 3, 7]],
            [[1, 2, 1], [1]],
            [[1, 2, 3, 4, 3, 2, 1], [3]],
            [[1, 2, 3, 4, 5], [-1]]
        ];
    }

    /**
     * @return array
     */
    public function exceptionsProvider(): array
    {
        return [
            [[1, 2, '3'], ArrayMustConsistOnlyIntException::class],
            [[1, 2, 2147483648], ArrayMustConsistOnlyIntException::class],
            [[1, 2, -2147483649], ArrayMustConsistOnlyIntException::class],
            [[101 => 1], ArrayKeysMustBeSequentialException::class],
            [range(0,100001), ArrayTooLargeException::class]
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $array
     * @param array $possibleResult
     */
    public function testSolve(array $array, array $possibleResult)
    {
        $solver = \SolverFactory::create(\Solver::class);
        $result = $solver->solve($array);
        $this->assertArraySubset([$result], $possibleResult);
    }

    /**
     * @dataProvider exceptionsProvider
     * @param array $array
     * @param string $exceptionClass
     */
    public function testExceptions(array $array, string $exceptionClass)
    {
        $this->expectException($exceptionClass);
        $solver = \SolverFactory::create(\Solver::class);
        $solver->solve($array);
    }
}
