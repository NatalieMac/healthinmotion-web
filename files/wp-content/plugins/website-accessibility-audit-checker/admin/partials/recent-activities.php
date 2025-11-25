<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

if (!function_exists('aaa_time_elapsed_string')) {
  function aaa_time_elapsed_string($datetime, $full = false)
  {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $string = [
      'y' => 'year',
      'm' => 'month',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
    ];
    foreach ($string as $key => &$value) {
      if ($diff->$key) {
        $value = $diff->$key . ' ' . $value . ($diff->$key > 1 ? 's' : '');
      } else {
        unset($string[$key]);
      }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }
}


?>
<div class="">
  <div class="flex items-center mb-5">
    <h3 class="text-lg font-semibold text-gray-800">
      <?php esc_html_e('Recent activities', 'aaardvark'); ?>
    </h3>
  </div>

  <?php if (! empty($response['meta']['recent_activity'])) : ?>

    <?php foreach ($response['meta']['recent_activity'] as $activity) : ?>

      <?php switch ($activity['loggable_type']):
        case 'App\Models\Scan': ?>

          <div class="bg-white rounded-lg shadow overflow-hidden transition duration-200 mt-4">
            <div class="flex content-center justify-between flex-wrap px-6 py-4">
              <div class="flex w-full">
                <!-- Left Icon -->
                <div class="mr-5">
                  <span class="inline-block bg-blue-100 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-blue-600">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"></path>
                    </svg>
                  </span>
                </div>

                <!-- Main Content -->
                <div class="grow flex flex-col">
                  <!-- Title and Date -->
                  <div class="flex justify-between items-center">
                    <h4 class="font-semibold text-base text-gray-800">
                      <?php
                      // Ensure $activity is an array/object and contains 'loggable'
                      if (!empty($activity['loggable']['source'])) {
                        $scan_type = $activity['loggable']['source'];
                        $scan_source = !empty($activity['loggable']['source']) ? $activity['loggable']['source'] : 'Unknown';
                        $user_name = !empty($activity['user']['name']) ? esc_html($activity['user']['name']) : 'System';
                        $pages_scanned = !empty($activity['loggable']['crawl_successes']) ? intval($activity['loggable']['crawl_successes']) : 0;

                        if ($scan_type === 'Manual') {
                          if (!empty($activity['user'])) {
                            echo "Manual Site Scan by " . $user_name;
                          } elseif (strpos($scan_source, 'weekly') !== false) {
                            echo "Weekly Site Scan";
                          } elseif (strpos($scan_source, 'daily') !== false) {
                            echo "Daily Site Scan";
                          } else {
                            echo "Full Site Scan Triggered by " . esc_html($scan_source);
                          }
                        } else {
                          echo "Custom Scan Triggered";
                        }
                      }
                      ?>
                    </h4>
                    <span class="text-cool-gray-600 text-sm">
                      <?php echo aaa_time_elapsed_string($activity['created_at']); ?>
                    </span>
                  </div>

                  <!-- Scan Status Details -->
                  <div class="flex justify-between items-end mt-2">
                    <div class="text-cool-gray-500">
                      <ul>
                        <li><?php echo isset($activity['loggable']['crawl_successes']) ? intval($activity['loggable']['crawl_successes']) : 0; ?> pages scanned.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php break;

        case 'App\Models\Issue': ?>
          <div class="bg-white rounded-lg shadow overflow-hidden transition duration-200 mt-4">
            <div class="flex content-center justify-between items-center px-6 p-3 flex-wrap">
              <div class="flex items-center">
                <div class="mr-5">
                  <span class="inline-block bg-blue-100 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-7 h-7 text-blue-600">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3"></path>
                    </svg>
                  </span>
                </div>
                <p class="ml-4 font-semibold text-base text-gray-800">
                  <?= esc_html($activity['message']); ?>
                </p>
              </div>
              <div>
                <span class="text-gray-600 text-sm">
                  <?= esc_html(human_time_diff(strtotime($activity['created_at']), current_time('timestamp'))) . ' ' . __('ago', 'your-text-domain'); ?>
                </span>
              </div>
            </div>
          </div>

        <?php break;

        case 'App\Models\Comment': ?>
          <div class="bg-white rounded-lg shadow overflow-hidden transition duration-200 text-base mt-4">
            <div class="flex content-center justify-between px-6 py-4 flex-wrap">
              <div class="flex max-w-2xl">
                <div class="mr-5">
                  <span class="inline-block bg-blue-100 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-7 h-7 text-blue-600">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"></path>
                    </svg>
                  </span>
                </div>
                <div>
                  <p class="font-semibold text-base text-gray-800">
                    <?= htmlspecialchars($activity['user']['name']) ?> commented on
                    <a href="/issues/<?= $activity['loggable']['issue_id'] ?>">issue #<?= $activity['loggable']['issue_id'] ?></a>,
                    instance #<?= $activity['loggable']['commentable_id'] ?>
                  </p>
                  <div>
                    <?php
                    $fullBody = htmlspecialchars($activity['loggable']['body']);
                    $fullBody = preg_replace('/\{@(.*?):\d+\}/', '$1', $fullBody);
                    $truncatedBody = implode(' ', array_slice(explode(' ', $fullBody), 0, 14));
                    $isTruncated = str_word_count($fullBody) > 14;
                    ?>

                    <div x-data="{ showFull: false }">
                      <span x-show="!showFull">
                        <p class="mt-4 text-gray-500 leading-4"><?= nl2br($truncatedBody) ?>...</p>
                        <?php if ($isTruncated): ?>
                          <a href="#" class="text-blue-500" @click.prevent="showFull = true">Continue Reading</a>
                        <?php endif; ?>
                      </span>

                      <span x-show="showFull">
                        <p class="mt-4 text-gray-500"><?= nl2br($fullBody) ?></p>
                        <a href="#" class="text-blue-500" @click.prevent="showFull = false">Hide</a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <span class="text-gray-600 text-sm"><?= aaa_time_elapsed_string($activity['created_at']) ?></span>
              </div>
            </div>
          </div>


        <?php break;

        default: ?>
          <div class="p-4">
            <?= esc_html($activity['message'] ?? ''); ?>
          </div>
      <?php break;
      endswitch; ?>

    <?php endforeach; ?>

  <?php else : ?>
    <span class="text-xs text-gray-500">
      No scan has been performed yet
    </span>
  <?php endif; ?>
</div>