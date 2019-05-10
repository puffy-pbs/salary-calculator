<?php


abstract class TaskList implements IList
{
    /**
     * @desc retrieve report list
     * @return array
     */
    abstract public function get(): array;
}