PicossSonataExtraAdminBundle Configuration Reference
====================================================

All available configuration options are listed below with their default values.

``` yaml
# config/packages/picoss_sonata_extra_admin.yaml
picoss_sonata_extra_admin:
  templates:
    history:                    @PicossSonataExtraAdmin/CRUD/history.html.twig
    history_revert:             @PicossSonataExtraAdmin/CRUD/history_revert.html.twig
    history_revision_timestamp: @PicossSonataExtraAdmin/CRUD/history_revision_timestamp.html.twig
    trash:                      @PicossSonataExtraAdmin/CRUD/trash.html.twig
    untrash:                    @PicossSonataExtraAdmin/CRUD/untrash.html.twig
    inner_trash_list_row:       @PicossSonataExtraAdmin/CRUD/list_trash_inner_row.html.twig
    button_trash:               @PicossSonataExtraAdmin/Button/trash_button.html.twig
    types:
      list:
        image:           @PicossSonataExtraAdmin/CRUD/list_image.html.twig
        badge:           @PicossSonataExtraAdmin/CRUD/list_badge.html.twig
        label:           @PicossSonataExtraAdmin/CRUD/list_label.html.twig
        progress_bar:    @PicossSonataExtraAdmin/CRUD/list_progress_bar.html.twig
        string_template: @PicossSonataExtraAdmin/CRUD/list_string_template.html.twig
      show:
        image:           @PicossSonataExtraAdmin/CRUD/show_image.html.twig
        badge:           @PicossSonataExtraAdmin/CRUD/show_badge.html.twig
        label:           @PicossSonataExtraAdmin/CRUD/show_label.html.twig
        progress_bar:    @PicossSonataExtraAdmin/CRUD/show_progress_bar.html.twig
        string_template: @PicossSonataExtraAdmin/CRUD/show_string_template.html.twig

```
