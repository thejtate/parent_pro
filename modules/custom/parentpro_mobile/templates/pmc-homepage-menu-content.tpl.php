<?php
/**
 * Created by PhpStorm.
 * User: Sergey Grigorenko (svipsa@gmail.com)
 * Date: 21.01.15
 * Time: 14:34
 */

?>

<div class="cols cols-two style-a">
  <div class="col col-1">
    <div class="col-bd">
      <div class="col-inner">
        <?php print render($left); ?>
      </div>
    </div>
  </div>
  <div class="col col-2">
    <div class="col-bd">
      <div class="col-inner">
        <?php print render($right); ?>
      </div>
    </div>
  </div>
</div>