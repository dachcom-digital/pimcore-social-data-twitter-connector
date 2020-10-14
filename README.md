# Pimcore Social Data - Twitter Connector

This Connector allows you to fetch social posts from Twitter. 

![image](https://user-images.githubusercontent.com/7426193/96001355-367c3800-0e38-11eb-8eb4-ca40dcd4a984.png)

#### Requirements
* [Pimcore Social Data Bundle](https://github.com/dachcom-digital/pimcore-social-data)

## Installation

### I. Add Dependencies
```json
"require" : {
    "dachcom-digital/social-data-twitter-connector" : "~1.0.0"
}
```

### II. Register Connector Bundle
```php
// src/AppKernel.php
use Pimcore\Kernel;
use Pimcore\HttpKernel\BundleCollection\BundleCollection;

class AppKernel extends Kernel
{
    public function registerBundlesToCollection(BundleCollection $collection)
    {
        $collection->addBundle(new SocialData\Connector\Twitter\SocialDataTwitterConnectorBundle());
    }
}
```

### III. Install Assets
```bash
bin/console assets:install web --relative --symlink
```

## Third-Party Requirements
To use this connector, this bundle requires some additional packages:
- [J7mbo/twitter-api-php](https://github.com/J7mbo/twitter-api-php)

## Enable Connector

```yaml
# app/config/config.yml
social_data:
    social_post_data_class: SocialPost
    available_connectors:
        -   connector_name: twitter
```

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
