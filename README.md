# Pimcore Social Data - X (Twitter) Connector

[![Software License](https://img.shields.io/badge/license-GPLv3-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Software License](https://img.shields.io/badge/license-DCL-white.svg?style=flat-square&color=%23ff5c5c)](LICENSE.md)
[![Latest Release](https://img.shields.io/packagist/v/dachcom-digital/social-data-twitter-connector.svg?style=flat-square)](https://packagist.org/packages/dachcom-digital/social-data-twitter-connector)
[![Tests](https://img.shields.io/github/actions/workflow/status/dachcom-digital/pimcore-social-data-twitter-connector/.github/workflows/codeception.yml?branch=master&style=flat-square&logo=github&label=codeception)](https://github.com/dachcom-digital/pimcore-social-data-twitter-connector/actions?query=workflow%3ACodeception+branch%3Amaster)
[![PhpStan](https://img.shields.io/github/actions/workflow/status/dachcom-digital/pimcore-social-data-twitter-connector/.github/workflows/php-stan.yml?branch=master&style=flat-square&logo=github&label=phpstan%20level%204)](https://github.com/dachcom-digital/pimcore-social-data-twitter-connector/actions?query=workflow%3A"PHP+Stan"+branch%3Amaster)

This Connector allows you to fetch social posts from Twitter (API v2). 

![image](https://user-images.githubusercontent.com/7426193/96001355-367c3800-0e38-11eb-8eb4-ca40dcd4a984.png)

### Release Plan
| Release | Supported Pimcore Versions | Supported Symfony Versions | Release Date | Maintained     | Branch                                                                                   |
|---------|----------------------------|----------------------------|--------------|----------------|------------------------------------------------------------------------------------------|
| **3.x** | `11.0`                     | `6.4`                      | 07.11.2023   | Feature Branch | master                                                                                   |
| **2.x** | `10.1` - `10.6`            | `5.4`                      | 05.01.2022   | Unsupported    | [2.x](https://github.com/dachcom-digital/pimcore-social-data-twitter-connector/tree/2.x) |
| **1.x** | `6.0` - `6.9`              | `3.4`, `^4.4`              | 22.10.2020   | Unsupported    | [1.x](https://github.com/dachcom-digital/pimcore-social-data-twitter-connector/tree/1.x) |

## Installation

```json
"require" : {
    "dachcom-digital/social-data" : "~3.1.0",
    "dachcom-digital/social-data-twitter-connector" : "~3.2.0"
}
```

Add Bundle to `bundles.php`:
```php
return [
    SocialData\Connector\Twitter\SocialDataTwitterConnectorBundle::class => ['all' => true],
];
```

### Install Assets
```bash
bin/console assets:install public --relative --symlink
```

## Enable Connector

```yaml
# config/packages/social_data.yaml
social_data:
    social_post_data_class: SocialPost
    available_connectors:
        -   connector_name: twitter
```

## Twitter Backoffice
Some hints to set up your Twitter app:
- Create Project via https://developer.x.com
- Generate Keys in `Keys and tokens` in section `Access Token and Secret`
- Be aware, that the `free limit` plan only allows `1 requests / 15 mins`

## Connector Configuration
![image](https://user-images.githubusercontent.com/7426193/96001424-4c89f880-0e38-11eb-90a8-586c5837e818.png)

Now head back to the backend (`System` => `Social Data` => `Connector Configuration`) and checkout the twitter tab.
- Click on `Install`
- Click on `Enable`
  
## Connection
Twitter is auto connected after you have filled out the connector configuration fields.

## Feed Configuration

| Name      | Description                                                     |
|-----------|-----------------------------------------------------------------|
| `User Id` | Defines which user entries should be imported                   |
| `Count`   | Define a limit to restrict the amount of social posts to import |

***

## Upgrade Info
Before updating, please [check our upgrade notes!](UPGRADE.md)

## License
**DACHCOM.DIGITAL AG**, Löwenhofstrasse 15, 9424 Rheineck, Schweiz  
[dachcom.com](https://www.dachcom.com), dcdi@dachcom.ch  
Copyright © 2025 DACHCOM.DIGITAL. All rights reserved.  

For licensing details please visit [LICENSE.md](LICENSE.md)  
