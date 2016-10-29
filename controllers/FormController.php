<?php


namespace app\controllers;

use app\models\UrlLink;
use yii\base\Controller;
use yii\data\Pagination;


class FormController extends Controller
{

    public function actionIndex(){

    if(\Yii::$app->request->isPost){ // проверка на получене данных методом POST
        $url_page=\Yii::$app->request->post('url');
        $curl=curl_init($url_page);
        curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curl, CURLOPT_FOLLOWLOCATION , 1 );
        curl_setopt( $curl, CURLOPT_URL, $url_page);
        $html = curl_exec($curl);
        $document = \phpQuery::newDocument($html);
        $news = $document->find("a");

        foreach ($news as $link){
            $model=new UrlLink();
            $url=pq($link)->attr('href');
            $urlText=pq($link)->text();
            $model->page_url=$url_page;
            $model->link_name=$urlText;
            $model->link_url=$url;
            $model->save();
        }
    }
       
        $urls=UrlLink::find()->where('id > 0'); // вставил условие where для того, чтобы получить объект, а не массив

        $pages = new Pagination(
            ['totalCount' => $urls->count(),
                'pageSize'=>20,
                'forcePageParam'=>false,
                'pageSizeParam'=>false]);
        $models = $urls->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

    return $this->render('index',compact('models','pages'));
    }
}