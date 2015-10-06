# sitemap-bundle

Sitemap Symfony 2 Integration

## Installation

### Composer: add the **webit/sitemap-bundle** into **composer.json**

```json
{
    "require": {
        "php":              ">=5.3.2",
        "webit/sitemap-bundle": "dev-master"
    }
}
```

## Usage

### Register bundle in Kernel
Add following lines:

```
// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new Webit\Bundle\SitemapBundle\WebitSitemapBundle(),
    // ...
);
```

### Create your implementation of ***Webit\Sitemap\Exposer\UrlExposerInterface***

```php
namespace MyProject;

use Webit\Sitemap\Exposer\UrlExposerInterface;
use Webit\Sitemap\Model\UrlSet;
class MyExposer implements UrlExposerInterface
{
    /**
     * @return UrlSet
     */
    public function getUrlSet()
    {
        $urlSet = new UrlSet();
        
        $url = new Url();
        $url->setLocation('http://page.url/my-site');
        $urlSet->addUrl(new Url());
        
        // add to $urlSet all urls you need 
        
        return $urlSet;
    }
}
```

### Register your UrlExposer in a Service Container and tag it as ***webit_sitemap.url_exposer***

```xml
<?xml version="1.0" encoding="UTF-8" ?>
<container xmlns="http://symfony.com/schema/dic/services"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://symfony.com/schema/dic/services
        http://symfony.com/schema/dic/services/services-1.0.xsd">

    <parameters>
        <parameter key="my_project.my_exposer.class">MyProject\MyExposer</parameter>
    </parameters>

    <services>
        <service id="my_project.my_exposer" class="%my_project.my_exposer.class%">
            <tag name="webit_sitemap.url_exposer" />
        </service>
    </services>
</container>
```

or

```yaml
parameters:
    my_project.my_exposer.class: MyProject\MyExposer
    
services:
    my_project.my_exposer:
        class: %my_project.my_exposer.class%
        tags:
            - { name: webit_sitemap.url_exposer }
```

### Import sitemap routings

```yaml
sitemap:
    prefix: /
    resource: @WebitSitemapBundle/Resources/config/routing.xml
```

### Go to http://your-domain.com/sitemap to see generated file
