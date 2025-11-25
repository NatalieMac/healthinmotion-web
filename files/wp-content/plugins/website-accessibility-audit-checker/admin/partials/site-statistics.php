<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly
?>
<div>
  <div class="flex justify-between items-center">
    <h3 class="text-lg font-semibold text-gray-800">
      <?php esc_html_e('Site Statistics', 'aaardvark'); ?>
    </h3>
  </div>
  <div class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3">
    <div class="col-span-1">
      <?php include_once dirname(__DIR__) . '/partials/issues-by-impact.php'; ?>
    </div>
    <div class="col-span-1">
      <?php include_once dirname(__DIR__) . '/partials/active-issues.php'; ?>
    </div>
    <div class="col-span-1">
      <?php include_once dirname(__DIR__) . '/partials/average-instance-by-page.php'; ?>
    </div>


  </div>
</div>