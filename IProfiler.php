<?php
interface IProfiler
{
    public function startTimer(string $timerName);
    public function endTimer(string $timerName);
    public function getTimers() :array;
}