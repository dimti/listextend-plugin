<?php namespace Dimti\ListExtend\Classes\Registration;

use Backend\Classes\ListColumn;
use Illuminate\Support\Collection;
use October\Rain\Database\Attach\File;
use October\Rain\Database\Model;
use Lang;

trait ExtendListColumns
{
    public function registerListColumnTypes()
    {
        return [
            'switchcircle' => function ($value, ListColumn $column, Model $record) {
                $emptyClass = 'icon-circle-o';

                $filledClass = 'icon-circle';

                $onclick = sprintf(
                    <<<EOF
onclick="event.stopPropagation();$(this).request('onEditable');"
data-request-data="id: %d, columnName: '%s', type: 'switchcircle', fieldModelClass: '%s'"
data-current-value="%s"
data-request-success="%s %s %s %s"
EOF,
                    $record->id,
                    $column->columnName,
                    str_replace('\\','.', get_class($record)),
                    $record->{$column->columnName},
                    sprintf(
                        "emptyClass = '%s'; filledClass = '%s';",
                        $emptyClass,
                        $filledClass
                    ),
                    "el = $(this); el.removeClass(emptyClass).removeClass(filledClass);",
                    "iconClass = data.newValue ? filledClass : emptyClass;",
                    "el.attr('data-current-value', !!data.newValue); el.addClass(iconClass);"
                )
                ;

                $class = $value ? $filledClass : $emptyClass;

                $contents = sprintf(
                    '<i class="%s" title="%s" %s></i>',
                    $class,
                    $value,
                    $onclick
                );

                return $contents;
            },
            'simpleimage' => function ($value, ListColumn $column, Model $record) {
                if ($value) {
                    assert($value instanceof File);

                    $width = data_get($column, 'config.width', 'auto');

                    $height = data_get($column, 'config.height', 50);

                    $options = data_get($column, 'config.options', []);

                    $src = $value->getThumb($width, $height, $options);

                    return '<img src="' . $src . '"/>';
                }

                return '';
            },
            'simpleimageexists' => function ($value, ListColumn $column, Model $record) {
                if ($value) {
                    return Lang::get('dimti.listextend::lang.common.yes');
                }

                return Lang::get('dimti.listextend::lang.common.no');
            },
            'simpleimages' => function (Collection $value, ListColumn $column, Model $record) {
                $result = '';

                if ($value->count()) {

                    $width = data_get($column, 'config.width', 'auto');

                    $height = data_get($column, 'config.height', 50);

                    $options = data_get($column, 'config.options', []);

                    foreach ($value as $file) {
                        assert($file instanceof File);

                        $src = $file->getThumb($width, $height, $options);

                        $result .= '<img src="' . $src . '"/>';
                    }
                }

                return $result;
            },
            'simpleimagescount' => function ($value, ListColumn $column, Model $record) {
                return $value->count();
            },
        ];
    }
}
