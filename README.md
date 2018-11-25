# PhpinfoComparator

PhpinfoComparator is compare two `phpinfo()` files.

## Requirements

PhpinfoComparator has the following requirements:

* PHP >= 7.1.0

## Installation

Install PhpinfoComparator globally as a system wide by using the Composer:

```sh
composer global require ngmy/phpinfocmp
```

Or alternatively, install PhpinfoComparator locally as part of your project by using the Composer:

```sh
composer require ngmy/phpinfocmp
```

## Usage

Compare two `phpinfo()` files on two remote servers:

```sh
phpinfocmp http://server1/phpinfo http://server2/phpinfo > phpinfo_diff.html
```

Compare two html `phpinfo()` files on one local machine:

```sh
phpinfocmp --fetch-mode1=file --fetch-mode2=file phpinfo1.html phpinfo2.html > phpinfo_diff.html
```

Compare two text `phpinfo()` files on one local machine:

```sh
phpinfocmp --fetch-mode1=file --fetch-mode2=file --file-format1=text --file-format2=text phpinfo1.txt phpinfo2.txt > phpinfo_diff.html
```

You can combine different fetch modes and file formats:

```sh
phpinfocmp --fetch-mode2=file http://server1/phpinfo phpinfo.html > phpinfo_diff.html
```

```sh
phpinfocmp --fetch-mode1=file --fetch-mode2=file --file-format2=text phpinfo.html phpinfo.txt > phpinfo_diff.html
```

You can read fetch options from a specified PHP file:

```sh
phpinfocmp --fetch-options1=fetch_options.php --fetch-options2=fetch_options.php https://server1/phpinfo https://server2/phpinfo > phpinfo_diff.html
```

The PHP file must be an array format that can be passed to `curl_setopt_array()` as following:

```php
<?php

return [
    CURLOPT_SSL_VERIFYPEER => false,
];
```

## License

PhpinfoComparator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
