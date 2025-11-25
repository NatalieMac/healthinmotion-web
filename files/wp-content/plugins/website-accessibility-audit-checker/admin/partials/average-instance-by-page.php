<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly
?>
<div class="aaa-card !p-0 text-base overflow-hidden bg-white rounded-lg shadow flex flex-col justify-between">
  <div class="px-4 py-5 sm:p-6">
    <div class="flex items-center">
      <div class="shrink-0 p-3 bg-orange-400 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-6 h-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"></path>
        </svg>
      </div>
      <div class="flex-1 w-0 ml-5">
        <dt class="text-sm font-medium text-gray-500 truncate">
            <?php esc_html_e('Average Instances / Page', 'aaardvark'); ?>
        </dt>
        <dd class="flex items-center">
          <div class="text-2xl font-semibold text-gray-900">
            <?php echo isset($response['site']['open_issues_count']) ? floatval($response['site']['average_instances_page']) : 0; ?>
          </div>
        </dd>
      </div>
    </div>
    <div class="mt-4">
      <p class="font-bold text-gray-800 mb-1">
        <?php esc_html_e('Most problematic pages', 'aaardvark'); ?>
      </p>
      <?php if (empty($response['meta']['formatted']['problematic_pages'])): ?>
        <li class="list-decimal list-inside">
          <span class="font-medium">
            <?php esc_html_e('No issues found', 'aaardvark'); ?>
          </span>
        </li>
        <?php else: ?>
        <ul>
          <?php foreach ($response['meta']['formatted']['problematic_pages'] as $key => $page): ?>
            <li class="truncate">
              <a class="cursor-pointer font-medium text-aaardvark-500 hover:text-aaardvark-600" target="_blank" href="<?php echo esc_url($page['url']); ?>">
                <span>
                  <?php echo ++$key . ". " . $page['readable_name']; ?>
                </span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
  <div class="px-4 py-4 bg-gray-50 sm:px-6">
    <div class="text-sm">
      <a href="<?php echo esc_url($response['meta']['links']['pages_view']); ?>"
        target="_blank" 
        class="font-medium text-aaardvark-500 hover:text-aaardvark-600">
        <?php esc_html_e('View Pages', 'aaardvark'); ?>
      </a>
    </div>
  </div>
</div>