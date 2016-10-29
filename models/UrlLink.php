<?php

namespace app\models;

use Yii;


class UrlLink extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'url_link';
    }


    public function rules()
    {
        return [
            [['page_url', 'link_name', 'link_url'], 'required'],
            [['time'], 'safe'],
            [['page_url', 'link_name', 'link_url'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_url' => 'Страница Url',
            'link_name' => 'Текст ссылки',
            'link_url' => 'Адрес',
            'time' => 'Дата',
        ];
    }
}
