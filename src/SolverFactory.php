<?php
declare(strict_types = 1);

class SolverFactory
{
    /**
     * @param string $class
     * @return SolverInterface
     */
    public static function create(string $class): SolverInterface
    {
        return new $class;
    }
}
