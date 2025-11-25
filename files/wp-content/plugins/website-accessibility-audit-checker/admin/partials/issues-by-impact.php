<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly
?>
<div class="aaa-card !p-0 text-base flex flex-col justify-between">
  <div class="px-4 py-5 sm:p-6">
    <div class="flex items-start">
      <div class="shrink-0 p-3 bg-orange-400 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-6 h-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z"></path>
        </svg>
      </div>
      <div class="flex-1 w-0 ml-5">
        <dt class="text-sm font-medium text-gray-500 truncate">
          <?php esc_html_e('Issues by impact', 'aaardvark'); ?>
        </dt>
        <dd class="flex items-center">
        </dd>
      </div>
    </div>
    <div class="flex items-center justify-around mt-4">
      <?php if (!isset($response['site']['issue_count_by_severity'])): ?>
        <p class="text-sm text-gray-500">
          <?php esc_html_e('No issues found', 'aaardvark'); ?>
        </p>
      <?php else: ?>

        <?php
        $colors = [
          'Critical' => '#BD0026',
          'Moderate' => '#FECC5C',
          'Low' => '#FFFFB2',
          'Very High' => '#FD8D3C',
          'High' => '#F03B20',
          'Warning' => '#FEB24C',
          'Error' => '#F03B20',
        ];
        ?>

        <div class="w-1/2">
          <div class="w-full relative max-h-40"
            x-data="{ 
              chart: null, 
              chartData: <?php echo str_replace('"', "'", json_encode($response['siteView']['issueByImpactChart'])); ?>, 
              options: {
                plugins: {
                  legend: {
                    display:false
                  }
                },
                cutout:30,
                maintainAspectRatio:false,
                responsive:true
              }
            }"
            x-init="() => {
            const ctx = $refs.chartCanvas.getContext('2d');
            chart = new Chart(ctx, {
                type: 'doughnut',
                data: chartData,
                options: options
            });
        }">
            <canvas x-ref="chartCanvas" style="display: block; box-sizing: border-box; height: 160px; width: 140px;" width="211" height="240"></canvas>
          </div>
        </div>
        <div>
          <ul class="text-sm text-gray-500">
            <?php foreach ($response['site']['issue_count_by_severity'] as $severity => $count): ?>

              <?php if (!isset($colors[$severity])) continue; ?>
              <li>
                <span class="w-max text-xs">
                  <span class="w-2.5 h-2.5 inline-block rounded-full border border-black" style="background-color: <?php echo isset($colors[$severity]) ? $colors[$severity] : 'white'; ?>"></span>
                  <?php echo $count . ' ' . ucfirst($severity); ?>
                </span>
              </li>
            <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="px-4 py-4 bg-gray-50 sm:px-6">
    <div class="text-sm">
      <a href="<?php echo esc_url($response['meta']['links']['issues_view']); ?>"
        target="_blank"
        class="font-medium text-aaardvark-500 hover:text-aaardvark-600">
        <?php esc_html_e('View Issues', 'aaardvark'); ?>
      </a>
    </div>
  </div>
</div>