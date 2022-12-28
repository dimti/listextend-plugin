<?php namespace Dimti\ListExtend\Behaviors;

use Backend\Classes\ControllerBehavior;
use Illuminate\Support\Collection;

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
                if (starts_with($columnName, 'pivot')) {
                    $parentModelId = intval(array_reverse(explode('/', \Request::path()))[0]);

                    $relationField = post('_relation_field');

                    $parentModel = $listModelClass::whereKey($parentModelId)
                        ->with([
                            $relationField => fn ($query) => $query->whereKey($id)
                        ])->first()
                    ;

                    $relatedModel = $parentModel->$relationField instanceof Collection ?
                        $parentModel->$relationField->first() :
                        $parentModel->$relationField;

                    $columnNameInPivot = rtrim(str_replace('pivot[', '', $columnName), ']');

                    $pivotModel = $relatedModel->pivot;

                    $newValue = !$pivotModel->$columnNameInPivot;

                    $pivotModel->setAttribute($columnNameInPivot, $newValue);

                    $pivotModel->save();
                } else {
                    $newValue = !$model->$columnName;

                    $model->setAttribute($columnName, $newValue)->save();
                }

                return [
                    'newValue' => $newValue,
                ];
        }
    }
}
