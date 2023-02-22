<?php

require_once 'IProfiler.php';
require_once 'Timer.php';

class Profiler implements IProfiler {
    private $timers = array(); // массив таймеров
    public function startTimer(string $timerName) {
        $currentTimer = array_key_exists($timerName, $this->timers) ? $this->timers[$timerName] : null;
        if (is_null($currentTimer)) {
            $currentTimer = new Timer($timerName);
            $this->timers[$timerName] = $currentTimer;
        } else {
            $currentTimer->setStart();
            $currentTimer->setCount();
        }

        foreach ($this->timers as $timer) {
            if ($timer->getTimerName() !== $timerName && $timer->getIsCounting()) {
                $timer->setEnd();
            }
        }
    }
    public function endTimer(string $timerName) {
        $currentTimer = array_key_exists($timerName, $this->timers) ? $this->timers[$timerName] : null;
        if(!is_null($currentTimer)){
            $currentTimer->setEnd();
        }
        foreach ($this->timers as $timer) {
            if ($timer->getTimerName() !== $timerName && (!$timer->getIsCounting() || $timer->getCountingTimes() % 2 != 0)) {
                $timer->setStart();
            }
        }
    }
    public function getTimers() :array {
        $result = array();
        foreach($this->timers as $timer) {
            $result[$timer->getTimerName()]['duration'] = sprintf( '%.3f sec.', $timer->getDuration());
            $result[$timer->getTimerName()]['count'] = $timer->getCount();
        }
        return $result;
    }
}
