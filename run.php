<?php
declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

$arr = [-1, 3, -4, 5, 1, -6, 2, 1];
$solver = SolverFactory::create(Solver::class);

try {
    $equilibrium = $solver->solve($arr);

    if ($equilibrium !== -1) {
        echo sprintf("P = %d\n", $equilibrium);
    } else {
        echo sprintf("lack of equilibrium\n");
    }

} catch (\InvalidArgumentException $e) {
    echo sprintf("Bad input array.\n");
}
