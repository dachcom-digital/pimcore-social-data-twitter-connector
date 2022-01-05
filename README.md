# Pimcore Social Data - Twitter Connector

[![Software License](https://img.shields.io/badge/license-GPLv3-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Release](https://img.shields.io/packagist/v/dachcom-digital/social-data-twitter-connector.svg?style=flat-square)](https://packagist.org/packages/dachcom-digital/social-data-twitter-connector)
[![Tests](https://img.shields.io/github/workflow/status/dachcom-digital/pimcore-social-data-twitter-connector/Codeception/master?style=flat-square&logo=github&label=codeception)](https://github.com/dachcom-digital/pimcore-social-data-twitter-connector/actions?query=workflow%3ACodeception+branch%3Amaster)
[![PhpStan](https://img.shields.io/github/workflow/status/dachcom-digital/pimcore-social-data-twitter-connector/PHP%20Stan/master?style=flat-square&logo=github&label=phpstan%20level%204)](https://github.com/dachcom-digital/pimcore-social-data-twitter-connector/actions?query=workflow%3A"PHP+Stan"+branch%3Amaster)

This Connector allows you to fetch social posts from Twitter (API v2). 

![image](https://user-images.githubusercontent.com/7426193/96001355-367c3800-0e38-11eb-8eb4-ca40dcd4a984.png)

### Release Plan
| Release | Supported Pimcore Versions        | Supported Symfony Versions | Release Date | Maintained     | Branch     |
|---------|-----------------------------------|----------------------------|--------------|----------------|------------|
| **2.x** | `10.1` - `10.2`                   | `5.4`                      | --           | Feature Branch | master     |
| **1.x** | `6.0` - `6.9`                     | `3.4`, `^4.4`              | 22.10.2020   | Unsupported    | 1.x        |

## Installation

### I. Add Dependencies
```json
"require" : {
    "dachcom-digital/social-data" : "~2.0.0",
    "dachcom-digital/social-data-twitter-connector" : "~1.0.0"
}
```

### II. Register Connector Bundle
```php
// src/Kernel.php
namespace App;

use Pimcore\HttpKernel\BundleCollection\BundleCollection;

class Kernel extends \Pimcore\Kernel
{
    public function registerBundlesToCollection(BundleCollection $collection)
    {
        $collection->addBundle(new SocialData\Connector\Twitter\SocialDataTwitterConnectorBundle());
    }
}
```

### III. Install Assets
```bash
bin/console assets:install public --relative --symlink
```

## Enable Connector

```yaml
# app/config/config.yml
social_data:
    social_post_data_class: SocialPost
    available_connectors:
        -   connector_name: twitter
```
## Twitter Backoffice
Some hints to set up your twitter app:
- Create Project via https://developer.twitter.com
- Generate Keys in `Keys and tokens` in section `Access Token and Secret`

## Connector Configuration
![image](https://user-images.githubusercontent.com/7426193/96001424-4c89f880-0e38-11eb-90a8-586c5837e818.png)

Now head back to the backend (`System` => `Social Data` => `Connector Configuration`) and checkout the twitter tab.
- Click on `Install`
- Click on `Enable`
- Before you hit the `Connect` button, you need to fill you out the Connector Configuration. After that, click "Save".
  
## Connection
Twitter is auto connected with a valid token and token secret.
You can generate it on your [twitter developer account](https://developer.twitter.com/).

## Feed Configuration

| Name | Description
|------|----------------------|
| `Screen Name` | Defines which Screen entries should be imported |
| `Count` | Define a limit to restrict the amount of social posts to import |

## Copyright and license
Copyright: [DACHCOM.DIGITAL](http://dachcom-digital.ch)  
For licensing details please visit [LICENSE.md](LICENSE.md)  

## Upgrade Info
Before updating, please [check our upgrade notes!](UPGRADE.md)
