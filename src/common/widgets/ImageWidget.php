<?php

namespace yiicom\files\common\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yiicom\files\common\models\File;

class ImageWidget extends Widget
{
    /** @var File[] */
	public $images;

	public $from = 0;
	public $limit;
	public $preset = '';
	public $options = [];
	public $linkOptions = [];
	public $linkPreset;
	public $dataPreset;
	public $after;

	/**
	 * Группировка элементов в заданный тег, по умолчанию <div>
	 * @var type
	 */
	public $group = [];


	public function init()
	{
		parent::init();

		// TODO: add empty image to admin options?
//		if (empty($this->images)) {
//			$this->images[] = [
//				'fileName' => ImageFile::getDefaultImage(),
//				'nodeTypeId' => 1, // TODO:: заменить на что-то дефолтное
//				'alt' => '',
//				'title' => '',
//				'action' => 0,
//			];
//		}

		if(! is_array($this->images)) {
			$this->images = [$this->images];
		}
	}


	public function run()
	{
		$count = 0;
		$html = '';

		$groupQty = isset($this->group['qty']) ? $this->group['qty'] : 0;
		$groupTag = isset($this->group['tag']) ? $this->group['tag'] : 'div';
		$groupOptions = isset($this->group['options']) ? $this->group['options'] : [];
		$groupClose = 0;
		$groupOpen = false;

		foreach($this->images as $index => $image) {
			$content = '';

			if ($index < $this->from) {
				continue;
			}

			if (! empty($this->limit) && $this->limit == $count) {
				break;
			}

			$options = $this->options;
			$options['alt'] = $image->alt ?? '';
			$options['title'] = $image->title ?? '';

			if (isset($this->dataPreset)) {
				$options['data-image'] = '/' . $image->fileManager->getUrl($this->dataPreset);
			}

			// Открывающий тег группировки
			if($groupQty && ($count % $groupQty == 0)) {
				$content .= Html::beginTag($groupTag, $groupOptions)."\n";
				$groupClose = $count + $groupQty - 1;
				$groupOpen = true;
			}

			$img = Html::img('/' . $image->fileManager->getUrl($this->preset), $options)."\n";

			if($this->after) {
				$img .= $this->after;
			}

			if(isset($this->linkPreset)) {
				$content .= Html::a($img, '/' . $image->fileManager->getUrl($this->linkPreset), $this->linkOptions)."\n";
			} elseif(isset($this->linkOptions['href'])) {
				$content .= Html::a($img, '/' . $this->linkOptions['href'], $this->linkOptions)."\n";
			} else {
				$content .= $img;
			}

			// Закрывающий тег группировки
			if($groupQty && $groupClose == $count) {
				$content .= Html::endTag($groupTag)."\n";
				$groupClose = 0;
				$groupOpen = false;
			}

			// Последний закрывающий тег группировки
			// если элементов меньше чем заданнов опциях
			if($groupQty && $groupOpen && $image == end($this->images)) {
				$content .= Html::endTag($groupTag)."\n";
			}

			$count++;

			$html .= $content;
		}

		return $html;
	}



}