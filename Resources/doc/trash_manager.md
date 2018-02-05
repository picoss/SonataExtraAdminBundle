Audit Manager
=============

Trash manager for Gedmo soft deleteable entity.

## Setup Loggable Entity

Read [SoftDeleteable behavior](http://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/softdeleteable.md) to see how to setup a soft deleteable entity.

## Enable audit

Update your admin service to enable audit:

**XML**
``` xml
<?xml version="1.0" ?>
<!-- Picoss/DemoBundle/Resources/config/admin.xml -->
<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">
    <services>
        <service id="picoss.demo.admin.my_entity" class="Picoss\DemoBundle\Admin\MyEntityAdmin">
            <tag name="sonata.admin" manager_type="orm" group="Demo" label="Entity" trash="true" />
            <argument/>
            <argument>Picoss\DemoBundle\Entity\MyEntity</argument>
            <argument>PicossDemoBundle:MyEntityAdmin</argument>
        </service>
    </services>
</container>
```

**YAML**
``` yaml
# Picoss/DemoBundle/Resources/config/admin.yml
services:
    picoss.demo.admin.my_entity:
        class: Picoss\DemoBundle\Admin\MyEntityAdmin
        tags:
            - { name: sonata.admin, manager_type: orm, group: "Demo", label: "Entity", trash: true }
        arguments:
            - ~
            - Picoss\DemoBundle\Entity\MyEntity
            - PicossDemoBundle:MyEntityAdmin
```

## Enable the softdeleteable filter

Enable softdeleteable and softdeleteabletrash filter:

``` yaml
# app/config/config.yml
doctrine:
  orm:
    entity_managers:
      default:
        filters:
          softdeleteable:
            class: Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter
            enabled: true
          softdeleteabletrash:
            class: Picoss\SonataExtraAdminBundle\Filter\SoftDeleteableTrashFilter
            enabled: true
```

## Display trash button on admin

```php
<?php

namespace Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;

class MyEntityAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    public function configureActionButtons($action, $object = null)
    {
        $list = parent::configureActionButtons($action, $object);

        if (in_array($action, ['list'])
            && $this->hasRoute('trash')
        ) {
            $list['trash'] = [
                'template' => $this->getTemplate('button_trash'),
            ];
        }

        if (in_array($action, ['trash']) && $this->hasRoute('list')) {
            $list['list'] = [
                'template' => $this->getTemplate('button_list'),
            ];
        }

        return $list;
    }
    
    //...
}
``` 