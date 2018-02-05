Audit Manager
=============

Audit manager for Gedmo loggable entity.

## Setup Loggable Entity

Read [Loggable behavior](http://github.com/l3pp4rd/DoctrineExtensions/blob/master/doc/loggable.md) to see how to setup a loggable entity.

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
            <tag name="sonata.admin" manager_type="orm" group="Demo" label="Entity" audit="true" />
            <argument/>
            <argument>Picoss\DemoBundle\Entity\MyEntity</argument>
            <argument>PicossDemoBundle:MyEntityAdmin</argument>
        </service>
    </services>
</container>
```

**YAML**
``` yaml
# config/services.yaml
services:
    Picoss\DemoBundle\Admin\MyEntityAdmin
        tags:
            - { name: sonata.admin, manager_type: orm, group: "Demo", label: "Entity", audit: true }
        arguments:
            - ~
            - Picoss\DemoBundle\Entity\MyEntity
            - PicossDemoBundle:MyEntityAdmin
```
