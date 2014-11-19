<?php use yii\helpers\Url; ?>

<div class="row">
  <div class="col-md-12">
    <h1>Страницы:</h1>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <?php foreach($pages as $pageEntry): ?>
    <p><a href="<?php echo Url::to(["site/index", "alias" => $pageEntry->alias]) ?>"><?php echo $pageEntry->alias ?></a></p>
    <?php endforeach; ?>
  </div>
  <div class="col-md-9">
  <?php if(!empty($page)): ?>
    <?php foreach($page->getAttributes() as $type => $value): ?>
      <p><strong><?php echo $type ?>:</strong><?php echo $value; ?></p>
    <?php endforeach; ?>
  <?php endif; ?>
  </div>
</div>