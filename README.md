# ZeroMsg Laravel

[![Latest Stable Version](https://poser.pugx.org/megoxv/zeromsg/version.svg)](https://packagist.org/packages/megoxv/zeromsg)
[![PHP Version Require](http://poser.pugx.org/megoxv/zeromsg/require/php)](https://packagist.org/packages/megoxv/zeromsg)
[![License](https://poser.pugx.org/megoxv/zeromsg/license.svg)](https://packagist.org/packages/megoxv/zeromsg)
[![Downloads](https://poser.pugx.org/megoxv/zeromsg/d/total.svg)](https://packagist.org/packages/megoxv/zeromsg)


The ZeroMsg Laravel package provides a fluent interface to interact with the ZeroMsg API, supporting various message types such as text, image, voice, media, list messages, link previews, and locations.

## Installation

### Step 1: Require the Package

You can install the package via Composer. Run the following command in your terminal:

```bash
composer require megoxv/zeromsg
```

### Step 2: Configuration

Add your ZeroMsg API key and Device ID to your `.env` file:

```env
ZEROMSG_API_KEY=your_api_key_here
ZEROMSG_DEVICE_ID=your_device_id_here
```

## Usage

To use the ZeroMsg package, include the `ZeroMsg` facade in your Laravel project.

### Sending a Text Message

```php
use Megoxv\ZeroMsg\Facades\ZeroMsg;

ZeroMsg::create()
    ->message('Hello, this is a test message')
    ->to('34676010101')
    ->send();
```

### Sending an Image

```php
use Megoxv\ZeroMsg\Facades\ZeroMsg;

ZeroMsg::create()
    ->message('Check out this image!')
    ->image('https://example.com/image.jpg', 'image.jpg')
    ->to('34676010101')
    ->send();
```

### Sending a Voice Message

```php
use Megoxv\ZeroMsg\Facades\ZeroMsg;

ZeroMsg::create()
    ->voice('https://example.com/voice.mp3')
    ->to('34676010101')
    ->send();
```

### Sending a Media Message

```php
use Megoxv\ZeroMsg\Facades\ZeroMsg;

ZeroMsg::create()
    ->message('Check out this media file!')
    ->media('https://example.com/media.mp4', 'media.mp4')
    ->to('34676010101')
    ->send();
```

### Sending a List Message

```php
use Megoxv\ZeroMsg\Facades\ZeroMsg;

ZeroMsg::create()
    ->message('Check out this list!')
    ->listMessage(
        'Options',
        'Select',
        [
            [
                'title' => 'Section 1',
                'value' => 'option1',
                'description' => 'First option'
            ],
            [
                'title' => 'Section 2',
                'value' => 'option2',
                'description' => 'Second option'
            ]
        ]
    )
    ->to('34676010101')
    ->send();
```

### Sending a Link Preview

```php
use Megoxv\ZeroMsg\Facades\ZeroMsg;

ZeroMsg::create()
    ->message('Check out this link!')
    ->linkPreview('https://zeromsg.com')
    ->to('34676010101')
    ->send();
```

### Sending a Location

```php
use Megoxv\ZeroMsg\Facades\ZeroMsg;

ZeroMsg::create()
    ->location('37.7749', '-122.4194', 'San Francisco', 'California, USA')
    ->to('34676010101')
    ->send();
```

## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="zeromsg-config"
```

## Credits

- [Abdelmjid Saber](https://github.com/megoxv)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
