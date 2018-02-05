SonataExtraAdminBundle
======================

Provides some extra features to Sonata Admin.

## Installation

### Download SonataExtraAdminBundle using Composer

Add on composer.json (see http://getcomposer.org/)

``` js
"require" :  {
    // ...
    "picoss/sonata-extra-admin-bundle": "dev-master",
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar require picoss/sonata-extra-admin-bundle
```

Composer will install the bundle to your project's `vendor/picoss` directory.

### Register the bundle

To start using this bundle, register it in the Kernel:

``` php
<?php

// config/bundles.php

return [
    //...
    Picoss\SonataExtraAdminBundle\PicossSonataExtraAdminBundle::class => ['all' => true],
];
```

### Configure the bundle (optional)

This bundle comes with a default configuration.

See [Configuration reference](http://github.com/picoss/SonataExtraAdminBundle/blob/master/Resources/doc/configuration_reference.md) to override default configuration

### Next Step

Now that you have completed the basic installation and configuration of the
PicossSonataExtraAdmin, you are ready to learn about more advanced features and usages
of the bundle.

The following documents are available:

- [List View Types](list_view_types.md)
- [Show View Types](show_view_types.md)
- [List View Sortable Behavior](list_view_sortable.md)
- [Audit Manager](audit_manager.md)
- [Trash Manager](trash_manager.md)
