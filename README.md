## Install
`composer require dimti/listextend-plugin`

## Usage

Example `columns.yaml`. `is_active` column with type `switchricle`

```yaml
columns:
    id:
        label: wpstudio.projects::lang.fields.id
        type: number
    name:
        label: wpstudio.projects::lang.fields.name
        type: text
    is_active:
        label: wpstudio.projects::lang.fields.is_active
        type: switchcircle
        sortable: true
```

See screenshot on octobercms plugin page https://octobercms.com/plugin/dimti-listextend
