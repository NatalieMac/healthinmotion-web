<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div>
	<div class="aaa-card">
		<div class="h-full flex sm:mx-auto justify-between w-full flex-wrap">

			<div class="w-full lg:w-1/2 sm:pr-4 mr-4 mb-2 lg:mb-0 flex flex-col justify-between">
				<div>
					<h1 class="flex justify-start gap-2 items-center text-3xl font-bold leading-7 text-cool-gray-900 sm:leading-9">
						<span class="truncate">
							<?php echo $response['site']['name'] ?>
						</span>
						</span>
					</h1>
					<span class="flex items-center text-sm font-medium leading-5 text-cool-gray-500 sm:mr-6">
						<?php echo $response['site']['base_url'] ?>
					</span>
					<div class="flex items-center text-sm font-medium leading-5 capitalize sm:mt-1 text-cool-gray-500 sm:mr-6">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="shrink-0 mr-1.5 h-5 w-5 text-cool-gray-500">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
						</svg>
						<?php
						echo sprintf(
							'Using %d / %d Pages',
							number_format($response['site']['pages_count']),
							number_format($response['site']['page_limit'])
						);
						?>
					</div>
				</div>
			</div>

			<div class="flex flex-col justify-between h-auto lg:items-end md:items-start">
				<div class="mx-0 lg:mx-auto">
					<p>
						<span class="font-bold text-gray-800">
							<?php esc_html_e('Standard:', 'aaardvark'); ?>
						</span>
						<span class="text-cool-gray-500 font-semibold">
							<?php echo $response['site']['standard'] ?>
						</span>
					</p>
					<p>
						<span class="font-bold text-gray-800 test2">
							<?php esc_html_e('Display Level:', 'aaardvark'); ?>
						</span>
						<span class="text-cool-gray-500 font-semibold">
							<?php echo $response['site']['display_level']; ?>
						</span>
					</p>
					<p>
						<span class="font-bold text-gray-800">
							<?php esc_html_e('Scan Frequency:', 'aaardvark'); ?>
						</span>
						<span class="text-cool-gray-500 font-semibold capitalize">
							<?php echo $response['site']['scan_frequency']; ?>
						</span>
					</p>
					<p>
						<span class="font-bold text-gray-800">
							<?php esc_html_e('Authentication:', 'aaardvark'); ?>
						</span>
						<span class="text-cool-gray-500 font-semibold capitalize">
							<?php echo $response['site']['has_credentials'] ? 'True' : 'False'; ?>
						</span>
					</p>
				</div>
			</div>
		</div>

		<div class="lg:mt-auto flex w-full items-center justify-end">
			<div class="mt-3">
				<div>
					<div>
						<a 
							class="px-4 py-2 text-sm text-white leading-5 rounded-md inline-flex font-medium items-center border shadow-sm  focus:outline-none focus:ring-2 focus:ring-offset-2 cursor-pointer border-transparent bg-aaardvark-500 hover:bg-aaardvark-600 focus:ring-blue  md:ml-2 mt-1 hover:text-cool-gray-100 focus:border-blue-700 focus:ring-blue active:bg-blue-700" 
							target="_blank"
							href="<?php echo esc_url($response['meta']['links']['site_view']); ?>"
						>
							<?php esc_html_e('Visit App dashboard', 'aaardvark'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>