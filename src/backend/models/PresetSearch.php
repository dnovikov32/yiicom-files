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
        $query->andFilterWhere([
            '{{%files_presets}}.id' => $this->id,
            '{{%files_presets}}.width' => $this->width,
            '{{%files_presets}}.height' => $this->height,
            '{{%files_presets}}.quality' => $this->quality,
        ]);

        $query->andFilterWhere(['LIKE', '{{%files_presets}}.title', $this->title]);
        $query->andFilterWhere(['LIKE', '{{%files_presets}}.name', $this->name]);
        $query->andFilterWhere(['LIKE', '{{%files_presets}}.action', $this->action]);
        $query->andFilterWhere(['LIKE', '{{%files_presets}}.watermark', $this->watermark]);
    }
}
