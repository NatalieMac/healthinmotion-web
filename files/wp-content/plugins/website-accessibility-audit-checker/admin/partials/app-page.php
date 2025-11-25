	<?php
	if (! defined('ABSPATH')) exit; // Exit if accessed directly

	$options = get_option('aaardvark_options');
	$api_key = $options['api_key'];

	if (! empty($api_key)) {
		$service = new AAArdvark_Services($api_key, AAArdvark::API_BASE_URL, AAArdvark::API_VERSION);
		$response = $service->dashboard();
		$response = json_decode(json_encode($response), true);
	}
	?>

	<?php if (! empty($api_key)) { ?>
		<style>
			:root {
				--aaardvark-500: rgb(13, 72, 167);
				--aaardvark-600: rgb(5 34 80);
				--secondary-color: #f1f1f1;
				--tint-color: rgb(251, 146, 60);
				--tertiary-color: #ccc;
				--text-gray-500: #6b7280;
			}

			.main.svelte-1poroh8 {
				margin-top: 0px;
				margin-bottom: 0px;
				margin-left: auto;
				margin-right: auto;
				max-width: 72rem;
				padding: 1rem;
			}

			#wpfooter {
				display: none;
			}
		</style>
		<!-- Alpine.js CDN -->
		<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
		<!-- include chart.js cdn -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<div>

		</div>

		<?php if (! empty($response)): ?>
			<div class="main svelte-1poroh8">


				<div class="flex flex-col space-y-4 mt-4">
					<?php include_once dirname(__DIR__) . '/partials/top-banner.php'; ?>

					<?php include_once dirname(__DIR__) . '/partials/site-statistics.php'; ?>

					<?php include_once dirname(__DIR__) . '/partials/issues-chart.php'; ?>

					<?php include_once dirname(__DIR__) . '/partials/recent-activities.php'; ?>
				</div>
			</div>

		<?php else: ?>
			<div class="flex items-center justify-center h-screen">
				<div class="text-center">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-400 mx-auto">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M12 3.75c4.556 0 8.25 3.694 8.25 8.25s-3.694 8.25-8.25 8.25-8.25-3.694-8.25-8.25 3.694-8.25 8.25-8.25z"></path>
					</svg>
					<h2 class="text-xl font-semibold text-gray-700 mt-4">
						<?php esc_html_e('No Data Available', 'website-accessibility-audit-checker'); ?>
					</h2>
					<p class="text-gray-500 mt-2">
						<?php esc_html_e("We couldn't find any data to display. Try refreshing or check back later.", 'website-accessibility-audit-checker'); ?>
					</p>
				</div>
			</div>

		<?php endif ?>

		</div>
	<?php } else { ?>
		<div>
			<?php
			$site_url = site_url('/wp-admin/admin.php?page=aaardvark-settings');
			$setup_api_key_str = sprintf(
				__('Please set up your %1$s API Key %2$s to access statistics and reports.', 'website-accessibility-audit-checker'),
				'<a href="' . esc_url($site_url) . '">',
				'</a>',
			);
			echo wp_kses($setup_api_key_str, array(
				'a' => array(
					'href' => array(),
				),
			));
			?>
		</div>
	<?php } ?>