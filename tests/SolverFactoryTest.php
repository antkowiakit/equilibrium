<?php
declare(strict_types = 1);

namespace Tests;

class SolverFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $solver = \SolverFactory::create(\Solver::class);
        $this->assertInstanceOf(\SolverInterface::class, $solver);
    }
}
