# OWJA! PHP Helper

[![Latest Stable Version](https://poser.pugx.org/owja/php-helper/v/stable)](https://packagist.org/packages/owja/php-helper)
[![Travis](https://travis-ci.org/owja/php-helper.svg?branch=master)](https://travis-ci.org/owja/php-helper.svg?branch=master&format=flat-square)
[![License](https://poser.pugx.org/owja/php-helper/license)](https://packagist.org/packages/owja/php-helper)
[![Build Status](https://travis-ci.org/owja/php-helper.svg?branch=master)](https://travis-ci.org/owja/php-helper)

This Package is Open Source and under MIT license.

A few little Helper.

## Installation

```
$ composer require owja/php-helper
```

## Classes

#### \Owja\Helper\Data

```PHP

$sampleData = [
    'some' => [
        'value' => 'example',
        'othervalue' => new class {
            public function getSomething() {
                return 'else';
            }
        }
    ]
];

$data = new \Owja\Helper\Data($sampleData);

// $example = 'example';
$example = $data->get('some.value');

// $somethingElse = 'else';
$somethingElse = $data->get('some.othervalue.something');

// $null = null
$null = $data->get('this.does.not.exist');

```

#### \Owja\Helper\Random

```PHP

// $randomString = Random String with 128 alphanummeric Chars
$randomString = (string) new \Owja\Helper\Random(128);

// $randomString = Random String with 64 Numbers
$randomString = (string) new \Owja\Helper\Random(64, \Owja\Helper\Random::NUMBERS);

// Alternative
$rnd = new \Owja\Helper\Random();

$randomString64Chars = $rnd->generate(64);
$randomString64Numbers = $rnd->generate(64, \Owja\Helper\Random::NUMBERS);
$randomString256Hex = $rnd->generate(256, \Owja\Helper\Random::HEX);

```

##### Predefined Pools

```
\Owja\Helper\Random::ALNUM     = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
\Owja\Helper\Random::ALPHA     = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
\Owja\Helper\Random::HEX       = '0123456789abcdef';
\Owja\Helper\Random::NUMBERS   = '0123456789';
```
`\Owja\Helper\Random::ALNUM` is the default pool


## License

This bundle is under the MIT license. 