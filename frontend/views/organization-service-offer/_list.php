<div class="well">
  <ul class="nav nav-pills">
    <?php
      foreach ($service_offers as $service_offer => $key) {
        $label = $key['label'];
        $icon = $key['icon'];
        echo "<li data-toggle='tooltip' data-placement='left' title='$label'><span class='$icon'> </span> </li>";
      }
    ?>
  </ul>
</div>
