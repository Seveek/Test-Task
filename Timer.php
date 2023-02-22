<?php

// Таймер
class Timer {
    private $timerName; // имя таймера
    private $start; // время запуска
    private $end; // время остановки
    private $duration; // общая продолжительность работы таймера
    private $count = 0; // количество запусков таймера
    private $isCounting; // ведётся ли подсчёт
    private $countingTimes = 0; // сколько раз менялся isCounting

    function __construct($timerName) {
        $this->timerName = $timerName;
        $this->start = microtime( true);
        $this->count++;
        $this->isCounting = true;
        $this->countingTimes++;
    }

    public function getTimerName() {
        return $this->timerName;
    }

    public function setTimerName(string $timerName) {
        $this->timerName = $timerName;
    }

    public function setStart() {
        $this->start = microtime( true);
        $this->isCounting = true;
        $this->countingTimes++;
    }

    public function setEnd() {
        $this->end = microtime( true ) - $this->start;
        $this->duration += $this->end;
        $this->isCounting = false;
        $this->countingTimes++;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getCount() {
        return $this->count;
    }

    public function setCount() {
        return $this->count++;
    }

    public function getIsCounting() {
        return $this->isCounting;
    }

    public function getCountingTimes() {
        return $this->countingTimes;
    }

}
