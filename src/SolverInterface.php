<?php
declare(strict_types = 1);

interface SolverInterface
{
    /**
     * @param array[int] $array
     * @return int
     */
    public function solve(array $array): int;
}
