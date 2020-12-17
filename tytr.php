<?php

class Task {

    private $task_id;
    private $description;
    private $deadline;
    private $user_id;

    public function __construct(string $desc, string $dl, int $user, int $id = 0) {
        $this->task_id = $id;
        $this->description = $desc;
        $this->deadline = $dl;
        $this->user_id = $user;
    }