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
                $onclick = ' onclick="event.stopPropagation();$(this).request(\'onEditable\');"' .
                    ' data-request-data="id: ' . $record->id . ', columnName: \'' . $column->columnName . '\', type: \'switchcircle\', fieldModelClass: \'' . str_replace('\\','.', get_class($record)) . '\'"' .
                    ' data-current-value="' . $record->{$column->columnName} . '"' .
                    ' data-request-success="var $el=$(this);var v=parseInt($el.attr(\'data-current-value\'));$el.attr(\'data-current-value\', v ? 0 : 1);$el.removeClass(\'icon-circle\').removeClass(\'icon-circle-o\').addClass(\'icon-circle\' + (!v ? \'\' : \'-o\'))"';

                $class = $value ? 'icon-circle' : 'icon-circle-o';

                $contents = '<i class="' . $class . '" title="' . $value . '" ' . $onclick . '></i>';

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
