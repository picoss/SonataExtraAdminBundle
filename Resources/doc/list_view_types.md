List View Types
===============

PicossSonataExtraAdminBundle provides new list view types:

- Image,
- Badge,
- Label,
- Progress Bar,
- String Template.

## Image type

To display an image, simply use `image` type.

#### Default usage

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
        ...
        ->add('picture', 'image')
    ;
}

```

#### Available options

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
        ...
        ->add('picture', 'image', [
            'prefix' => '/bundles/acme/images/', // Image url prefix, default to null
            'width' => 75, // Image width, default to 50px,
            'height' => 75, // Image height, default to 50px,
        ])
    ;
}

```

## Badge type

To display the value as a badge, use `badge` type.
For more informations see [Bootstrap Badges](http://getbootstrap.com/components/#badges)

#### Default usage

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
        ...
        ->add('name', 'badge')
    ;
}

```

## Label type

To display the value as a label, use `label` type.
For more informations see [Bootstrap Labels](http://getbootstrap.com/components/#labels)

#### Default usage

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
        ...
        ->add('name', 'label')
    ;
}

```

#### Available options

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
        ...
        ->add('name', 'label', array(
            /* Label appearance, could be one of the following:
             * primary, success, info, warning, danger
             */
            'style' => 'danger',
        ))
    ;
}

```

## Progress Bar type

To display a progress bar, use `progress_bar` type.
For more informations see [Bootstrap Progress bars](http://getbootstrap.com/components/#progress)

#### Default usage

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
        ...
        ->add('level', 'progress_bar')
    ;
}

```

#### Available options

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
        ...
        ->add('level', 'progress_bar', array(
            /* Progress bar appearance, could be one of the following:
             * success, info, warning, danger
             */
            'style' => 'danger',
            'striped' => true, // Add a striped effect
            'suffix' => '%', // Value suffix
        ))
    ;
}

```

## String Template type

To format the field value using html, use `string_template` type.

#### Default usage

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
        ...
        ->add('name', 'string_template', array(
            'string_template' => '<span class="pull-right">{{ value }}</span>'
        ))
    ;
}

```

#### Template options

You can also get the current object properties using `{{ object.property }}` in the template:

``` php

protected function configureListFields(ListMapper $listMapper)
{
    $listMapper
            ...
            ->add('fullname', 'string_template', array(
                'string_template' => '<span class="pull-right">{{ object.firstname }} {{ object.lastname }}</span>'
            ))
        ;
}

```

**Note:**
`string_template` type use `template_from_string()` twig function.
For more informations [see twig documentation](http://twig.sensiolabs.org/doc/functions/template_from_string.html)