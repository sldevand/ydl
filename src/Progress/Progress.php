<?php

namespace App\Progress;

/**
 * Class Progress
 * @package App\Progress
 */
class Progress
{
    /**
     * @var int $progress
     */
    private $progress;

    /**
     * @var Progress $instance
     */
    private static $instance;

    /**
     * @return Progress
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Progress();
        }
        return self::$instance;
    }

    /**
     * @return int
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @param int $progress
     * @return Progress
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;
        file_put_contents(ROOT . "dist/json/progress.json", json_encode(["status" => $this->progress]));
        return $this;
    }
}
