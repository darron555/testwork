<?
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<h1>Тестовое задание</h1><br><br>

<form class="form-horizontal" method="post" >
    <div class="form-group">
        <label for="inputUrl3" class="col-sm-2 control-label">Введите Url адрес </label>
        <div class="col-sm-10">
            <input type="url" name="url" class="form-control" id="inputUrl3" placeholder="http://yoururl.com" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Сканировать</button>
        </div>
    </div>
</form>
<hr>


<? if($models):?>
<div class="table-responsive">
    <table class="table table-striped .table-bordered">
        <? foreach ($models as $url):?>
        <tr><td><?=$url->page_url?></td><td><?=$url->link_name?></td><td><?=$url->link_url?></td><td><?=$url->time?></td></tr>
      <? endforeach;?>
        <?  echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </table>
</div>
<? endif;?>
