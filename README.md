# AWS Cognito Example

## Description

This is a sample program for verifying that server-side authentication has been performed after client authentication using "Amazon Cognito".

## Requirements

Web Server (Apache / Nginx / ... etc)

## Dependencies

None.

However, if you want to use a mechanism for server-side verification of "ID Token", you will need the following:

* PHP
* Composer

## Installation

```bash
$ git clone git@github.com:genzouw/aws-cognito-example.git

$ cd aws-cognito-example
```

## Usage

1. Set the `html/` directory as the document root and make it accessible by a browser.
2. Set the following environment variables. Please refer to the user pool setting page of "Amazon Cognito" for the setting value.
    * `COGNITO_DOMAIN`
    * `COGNITO_REGION_ID`
    * `COGNITO_USERPOOL_ID`
    * `COGNITO_CLIENT_ID`
    * `COGNITO_CALLBACK_URL=http://localhost:8080/callback.php`
    * `COGNITO_RESPONSE_TYPE=code` ( *# token or code* )
    * `COGNITO_CLIENT_SECRET` ( *# this environment variables are required when COGNITO_RESPONSE_TYPE = code* )

If the `php` command is available, the `php -S` command is available.

```bash
$ pwd
aws-cognito-example

# Move "Document root"
$ cd html

$ COGNITO_DOMAIN=your_domain
$ COGNITO_REGION_ID=your_region_id
$ COGNITO_USERPOOL_ID=your_userpool_iD
$ COGNITO_CLIENT_ID=your_client_ID
$ COGNITO_CALLBACK_URL=http://localhost:8080/callback.php
$ COGNITO_RESPONSE_TYPE=code
$ COGNITO_CLIENT_SECRET=your_client_secret

$ php -S localhost:8080
```

If you are using Apache, set environment variables using "SetEnv" directive.

## Relase Note

| date       | version | note           |
| ---        | ---     | ---            |
| 2019-05-28 | 0.1     | first release. |


## License

This software is released under the MIT License, see LICENSE.


## Author Information

[genzouw](https://genzouw.com)

* Twitter   : @genzouw ( https://twitter.com/genzouw )
* Facebook  : genzouw ( https://www.facebook.com/genzouw )
* LinkedIn  : genzouw ( https://www.linkedin.com/in/genzouw/ )
* Gmail     : genzouw@gmail.com
