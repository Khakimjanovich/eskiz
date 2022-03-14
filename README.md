# Eskiz.uz notifications channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/:package_name.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/:package_name)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/:package_name/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/:package_name)
[![StyleCI](https://styleci.io/repos/:style_ci_id/shield)](https://styleci.io/repos/:style_ci_id)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/:sensio_labs_id.svg?style=flat-square)](https://insight.sensiolabs.com/projects/:sensio_labs_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/:package_name.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/:package_name)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/:package_name/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/:package_name/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/:package_name.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/:package_name)

This package makes it easy to send notifications using [:service_name](link to service) with Laravel 5.5+, 6.x and 7.x

**Note:**
Replace ```:channel_namespace``` ```:service_name``` ```:author_name``` ```:author_username``` ```:author_website``` ```:author_email``` ```:package_name``` ```:package_description``` ```:style_ci_id``` ```:sensio_labs_id```
with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md)
, [LICENSE.md](LICENSE.md), [composer.json](composer.json) and other files, then delete this line.
**Tip:** Use "Find in Path/Files" in your code editor to find these keywords within the package directory and replace
all occurences with your specified term.

This is where your description should go. Add a little code example so build can understand real quick how the package
can be used. Try and limit it to a paragraph or two.

## Contents

- [Installation](#installation)
    - [Setting up the Eskiz](#setting-up-the-:service_name-service)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

This package can be installed via composer:

```composer require laravel-notification-channels/eskiz```

### Setting up the Eskiz service

1. Create an account and get the API key [here](https://notify.eskiz.uz/api/auth/login)

2. Add the API key to the `services.php` config file:

   ```php
   // config/services.php
   ...
   'eskiz' => [
       'api_key' => env('ESKIZ_API_KEY'),
       'from'    => env('ESKIZ_NICKNAME'),
   ],
   ...
   ```

## Usage

You can use this channel by adding `SMS77Channel::class` to the array in the `via()` method of your notification class.
You need to add the `toSms77()` method which should return a `new SMS77Message()` object.

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Eskiz\EskizChannel;
use NotificationChannels\Eskiz\EskizMessage;

class InvoicePaid extends Notification
{
    public function via($notifiable)
    {
        return [EskizChannel::class];
    }

    public function toEskiz() {
        return new EskizMessage('Mendan senga salomlar bolsin megajin!');
    }
}
```

### Available Message methods

- `getPayloadValue($key)`: Returns payload value for a given key.
- `content(string $message)`: Sets SMS message text.
- `to(string $number)`: Set recipients number.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [khakimjanovich](https://github.com/khakimjanovich)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
