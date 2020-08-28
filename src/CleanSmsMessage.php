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
     * CleanSmsMessage constructor.
     *
     * @param string $body
     */
    public function __construct($body = '')
    {
        $this->body($body);
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