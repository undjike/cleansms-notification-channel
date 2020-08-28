<?php

/*
 * CleanSmsServiceProvider.php
 *
 *  @author    Ulrich Pascal Ndjike Zoa <ndjikezoaulrich@gmail.com>
 *  @project    cleansms-notification-channel
 *
 *  Copyright 2020
 *  28/08/2020 00:14
 */

namespace Undjike\CleanSmsNotificationChannel;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Undjike\CleanSmsNotificationChannel\Channel\CleanSmsChannel;

class CleanSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application service.
     *
     * @return void
     * @noinspection PhpUnusedParameterInspection
     */
    public function boot()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('cleansms', function ($app) {
                return new CleanSmsChannel();
            });
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {}
}