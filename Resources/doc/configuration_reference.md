PicossSonataExtraAdminBundle Configuration Reference
====================================================

All available configuration options are listed below with their default values.

``` yaml
# app/config/config.yml
picoss_sonata_extra_admin:
  templates:
    history:                    PicossSonataExtraAdminBundle:CRUD:history.html.twig
    history_revert:             PicossSonataExtraAdminBundle:CRUD:history_revert.html.twig
    history_revision_timestamp: PicossSonataExtraAdminBundle:CRUD:history_revision_timestamp.html.twig
    trash:                      PicossSonataExtraAdminBundle:CRUD:trash.html.twig
    untrash:                    PicossSonataExtraAdminBundle:CRUD:untrash.html.twig
    inner_trash_list_row:       PicossSonataExtraAdminBundle:CRUD:list_trash_inner_row.html.twig
    list:                       PicossSonataExtraAdminBundle:CRUD:base_list.html.twig
    types:
      list:
        image:         PicossSonataExtraAdminBundle:CRUD:list_image.html.twig
        badge:         PicossSonataExtraAdminBundle:CRUD:list_badge.html.twig
        label:         PicossSonataExtraAdminBundle:CRUD:list_label.html.twig
        progress_bar:  PicossSonataExtraAdminBundle:CRUD:list_progress_bar.html.twig
        html_template: PicossSonataExtraAdminBundle:CRUD:list_html_template.html.twig
      show:
        image:         PicossSonataExtraAdminBundle:CRUD:show_image.html.twig
        badge:         PicossSonataExtraAdminBundle:CRUD:show_badge.html.twig
        label:         PicossSonataExtraAdminBundle:CRUD:show_label.html.twig
        progress_bar:  PicossSonataExtraAdminBundle:CRUD:show_progress_bar.html.twig
        html_template: PicossSonataExtraAdminBundle:CRUD:show_html_template.html.twig

```
