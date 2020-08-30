<p align="center"><img src="https://my.cleansms.biz/assets/images/logo.png" alt="logo"></p>

<p align="center">
<a href="https://packagist.org/packages/undjike/cleansms-notification-channel"><img src="https://poser.pugx.org/undjike/cleansms-notification-channel/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/undjike/cleansms-notification-channel"><img src="https://poser.pugx.org/undjike/cleansms-notification-channel/license.svg" alt="License"></a>
<a href="https://packagist.org/packages/undjike/cleansms-notification-channel"><img src="https://poser.pugx.org/undjike/cleansms-notification-channel/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/undjike/cleansms-notification-channel"><img src="https://poser.pugx.org/undjike/cleansms-notification-channel/dependents.svg" alt="Dependents"></a>
</p>

## Introduction

This is a package for Laravel Applications which enables you to send notifications through CleanSMS Channel.

The package uses <a href="https://github.com/undjike/cleansms">undjike/cleansms</a> to perform SMS dispatching.

## Installation

This package can be installed via composer. Just type :

```bash
composer require undjike/cleansms-notification-channel
```

## Usage

After installation, configure your services in `congig/services.php` by adding :

```php
<?php

return [
    //...

    'cleansms' => [
        'apikey' => env('CLEANSMS_APIKEY'), // You can type in directly your credentials 
        'email' => env('CLEANSMS_EMAIL')
    ],
];
```

Once this is done, you can create your notification as usual.

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Undjike\CleanSmsNotificationChannel\Channel\CleanSmsChannel;
use Undjike\CleanSmsNotificationChannel\CleanSmsMessage;

class CleanSmsNotification extends Notification
{
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [CleanSmsChannel::class]; // or return 'cleansms';
    }

    /**
     * @param $notifiable
     * @return mixed
     */
    public function toCleanSms($notifiable)
    {
        return CleanSmsMessage::create()
            ->body('Type here you message content...')
            ->transactional();
        // or return 'Type here you message content...';
    }
}

```

To get this stuff completely working, you need to add this
to your notifiable model.


```php
    /**
     * Attribute to use when addressing CleanSMS notification
     *
     * @returns string|array
     */
    public function routeNotificationForCleanSms()
    {
        return $this->phone_number; // Can be a string or an array of valid phone numbers
    }
```

Enjoy !!!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.