<?php

/*
 * CleanSmsMessage.php
 *
 *  @author    Ulrich Pascal Ndjike Zoa <ndjikezoaulrich@gmail.com>
 *  @project    cleansms-notification-channel
 *
 *  Copyright 2020
 *  27/08/2020 23:44
 */

namespace Undjike\CleanSmsNotificationChannel;

class CleanSmsMessage
{
    /**
     * Body of the message
     *
     * @var string
     */
    protected $body;

    /**
     * Transactional message
     *
     * @var bool
     */
    private $transactional;

    /**
     * CleanSmsMessage constructor.
     *
     * @param string $body
     * @param bool $transactional
     */
    public function __construct($body = '', $transactional = true)
    {
        $this->body($body);
        $this->transactional = $transactional;
    }

    /**
     * CleanSmsMessage pseudo-constructor.
     *
     * @param string $body
     * @return CleanSmsMessage
     */
    public static function create($body = '')
    {
        return new static($body);
    }

    /**
     * Set message to transactional
     *
     * @return CleanSmsMessage
     */
    public function transactional()
    {
        $this->transactional = true;
        return $this;
    }

    /**
     * Message is transactional
     *
     * @return bool
     */
    public function isTransactional()
    {
        return $this->transactional;
    }

    /**
     * Set message to not transactional
     *
     * @return CleanSmsMessage
     */
    public function campaign()
    {
        $this->transactional = false;
        return $this;
    }

    /**
     * Set message body
     *
     * @param string $body
     * @return CleanSmsMessage
     */
    public function body($body)
    {
        $this->body = trim($body);
        return $this;
    }

    /**
     * Get message body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
}