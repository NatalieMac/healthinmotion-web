<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly
?>
<div class="aaa-card !p-0 text-base">
  <div class="px-4 py-5 sm:p-6">
    <div class="flex items-center">
      <div class="shrink-0 p-3 bg-orange-400 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-6 h-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
        </svg>
      </div>
      <div class="flex-1 w-0 ml-5">
        <dt class="text-sm font-medium text-gray-500 truncate">
          <?php esc_html_e('Active Issues', 'aaardvark'); ?>
        </dt>
        <dd class="flex items-center">
          <div class="text-2xl font-semibold text-gray-900">
            <?php echo isset($response['site']['open_issues_count']) ? intval($response['site']['open_issues_count']) : 0; ?>
          </div>
        </dd>
      </div>
    </div>
    <div class="mt-4">
      <p class="font-bold text-gray-800 mb-1">
        <?php esc_html_e('Most Common Issues', 'aaardvark'); ?>
      </p>

      <?php if (empty($response['siteView']['issuesBySuccessCriteria'])): ?>
        <li class="list-decimal list-inside">
          <span class="font-medium">
            <?php esc_html_e('No issues found', 'aaardvark'); ?>
          </span>
        </li>

      <?php else: ?>
        <ol>
          <?php foreach ($response['siteView']['issuesBySuccessCriteria'] as $issue): ?>
            <li class="list-decimal list-inside">
              <span class="font-medium">
                <?php echo esc_html($issue['criteriaName']); ?>
              </span>
              <span class="text-gray-500">
                <?php echo esc_html($issue['count']); ?> <?php esc_html_e('Instances', 'aaardvark'); ?>
              </span>
            </li>
          <?php endforeach; ?>
        </ol>
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