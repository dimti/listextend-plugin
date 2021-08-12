<?php namespace Dimti\ListExtend\Behaviors;

use Backend\Classes\ControllerBehavior;

class SwitchcircleController extends ControllerBehavior
{
    public function onEditable()
    {
        $id = post('id');

        $columnName = post('columnName');

        $listModelClass = $this->controller->asExtension('ListController')->getConfig('modelClass');

        $fieldModelClass = str_replace('.','\\', post('fieldModelClass'));

        $modelClass= $fieldModelClass && $listModelClass != $fieldModelClass ? $fieldModelClass : $listModelClass;

        $model = $modelClass::find($id);

        switch (post('type')) {
            case 'switchcircle':
                $model->setAttribute($columnName, !$model->$columnName)->save();
                break;
        }
    }
}
