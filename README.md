# php-jwt-example

> **IMPORTANT:** This repository relates to Approov 1 and has not been updated to reflect the [new features](https://approov.io/docs/v2.0/changelog/) and [usage](https://approov.io/docs/v2.0/approov-usage-documentation/) of [Approov 2](https://approov.io/docs/v2.0/approov-installation/), the latest version of Approov. We will be updating the repository soon. Meanwhile, please refer to the [guide](https://approov.io/docs/v2.0/approov-usage-documentation/#migrating-from-approov-1) for migrating from Approov 1 to Approov 2.


> -----> NOT FOR PRODUCTION USAGE <-----

This just a demo to exemplify how [Approov](https://approov.io/approov-in-detail.html) tokens may be checked in PHP.

For production usage please use the package that best suites your framework of
choice.

This demo uses [firebase/php-jwt](https://github.com/firebase/php-jwt) and it is
a fork of [another fork](https://github.com/auth0/php-jwt-example).


## Setup

Install the dependencies with [Composer](https://getcomposer.org):

```bash
composer install
```

## Usage Instructions

### With your PHP Server

From the host shell:

```
$ php approov-examples.php`
```

### With PHP on Docker

From the host shell:

```bash
$ ./php-docker

php-fpm at 4f8f180c6c43 in /var/www/html (master●●●)
$
```

Now we are inside the docker container shell, and we just need to type:

```bash
php-fpm at 4f8f180c6c43 in /var/www/html (master●●●)
$ ./approov-examples.php
```

### Output

```bash
---> Try to decode with an empty Approov Secret <---

 * Invalid Argument Exception: Key may not be empty


---> Try to decode with an empty Approov JWT Token <---

 * Unexpected Value Exception: Wrong number of segments


---> Try to decode with a malformed Approov JWT token <---

 * Domain Exception: Malformed UTF-8 characters


---> Try to decode with an expired Approov JWT token <---

 * Unexpected Value Exception: Expired token


---> Try to decode with an Approov JWT token signed with an unknown secret <---

 * Unexpected Value Exception: Signature verification failed


---> Decode a Valid Approov JWT token <---

$decoded: object(stdClass)#2 (3) {
  ["iss"]=>
  string(6) "custom"
  ["pay"]=>
  string(44) "f3U2fniBJVE04Tdecj0d6orV9qT9t52TjfHxdUqDBgY="
  ["exp"]=>
  int(33083731896)
}
```

See [approov-examples.php](approov-examples.php) for the code examples.


## Issue Reporting

If you have found a bug please report them at this repository issues section.


## License

This project is licensed under the MIT license. See the [LICENSE](LICENSE) file for more info.
