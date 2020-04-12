<?php

namespace yiicom\files\backend\models;

use yii\db\ActiveQuery;
use yiicom\backend\search\SearchModelInterface;
use yiicom\backend\search\SearchModelTrait;
use yiicom\files\common\models\Preset;

class PresetSearch extends Preset implements SearchModelInterface
{
    use SearchModelTrait;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'width', 'height', 'quality'], 'integer'],

            [['title', 'name', 'action', 'watermark'], 'safe'],
        ];
    }

    /**
     * @param ActiveQuery $query
     */
    protected function prepareFilters($query)
    {
        $filesPreset = Preset::tableName();
        
        $query->andFilterWhere([
            "$filesPreset.id" => $this->id,
            "$filesPreset.width" => $this->width,
            "$filesPreset.height" => $this->height,
            "$filesPreset.quality" => $this->quality,
        ]);

        $query->andFilterWhere(['LIKE', "$filesPreset.title", $this->title]);
        $query->andFilterWhere(['LIKE', "$filesPreset.name", $this->name]);
        $query->andFilterWhere(['LIKE', "$filesPreset.action", $this->action]);
        $query->andFilterWhere(['LIKE', "$filesPreset.watermark", $this->watermark]);
    }
}
