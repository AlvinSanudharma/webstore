<?php

declare(strict_types=1);

namespace App\States\SalesOrder;

use App\States\SalesOrder\Transitions\PendingToCancel;
use App\States\SalesOrder\Transitions\PendingToProgress;
use App\States\SalesOrder\Transitions\ProgressToCompleted;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class SalesOrderState extends State 
{
    abstract public function label(): string;

    public static function config(): StateConfig
    {
        return parent::config()
                ->default(Pending::class)
                ->allowAllTransitions(Pending::class, Progress::class, PendingToProgress::class)
                ->allowAllTransitions(Pending::class, Cancel::class, PendingToCancel::class)
                ->allowAllTransitions(Progress::class, Completed::class, ProgressToCompleted::class);
    }
}