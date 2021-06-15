<?php

namespace Plugin\Providers;

use Radiate\Foundation\Providers\ScheduleServiceProvider as ServiceProvider;
use Radiate\Schedule\Schedule;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Schedule events
     *
     * @param \Radiate\Schedule\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule)
    {
        //
    }
}
