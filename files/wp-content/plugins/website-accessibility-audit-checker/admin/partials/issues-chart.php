<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(empty($response['meta']['issues_chart']['chartData']['labels'])) {
	return;
}
?>
<style>
	.canvas-wrapper {
		background-color: #fff;
		padding: 0.5rem;
		border-radius: 4px;
	}
	.hidden {
		display: none;
	}
	.tablinks {
		background-color: #fff;
		max-width: 150px;
		color: var(--text-gray-500);
		border: 1px solid transparent;
		cursor: pointer;
		padding: 10px;
		display: inline-block;
		position: relative;
	}
	.tablinks:first-of-type {
		border-radius: 4px 0 0 0;
	}
	.tablinks:last-of-type {
		border-radius: 0 4px 0 0;
	}
	.tablinks:first-of-type::after {
		content: "";
		display: block;
		width: 1px;
		height: 100%;
		background-color: #ccc;
		position: absolute;
		right: -1px;
		top: 0;
		z-index: 1;
	}
	.tablinks[aria-selected="true"] {
		/* background-color: #ccc; */
		color: var(--aaardvark-500);
		border-bottom: 1px solid var(--aaardvark-500);
	}
	[role="tablist"] {
		display: flex;
	}
	[role="tab"] {
		flex: 1;
	}
	[role="tabpanel"][hidden] {
		display: none;
	}
	[role="tabpanel"][aria-hidden="false"] {
		display: block;
	}
	[role="tabpanel"] a {
		display: block;
	}
	[role="tabpanel"] a:focus {
		outline: 2px solid #f00;
	}
</style>
<div>
	<div class="flex items-center mb-5">
    <h3 class="text-lg font-semibold text-gray-800">
      <?php esc_html_e('Count History', 'aaardvark'); ?>
    </h3>
  </div>

	<!-- Tabs -->
	<div class="tabs">
		<div role="tablist" aria-label="Sample Tabs">
				<button 
					role="tab" 
					type="button" 
					aria-controls="tabpanel-1" 
					id="issuesTab"
					class="tablinks" 
					tabindex="0"
					aria-selected="true"
				>Issues</button>
				<button 
					role="tab" 
					tabindex="-1" 
					aria-controls="tabpanel-2"
					id="instancesTab"
					type="button" 
					class="tablinks" 
				>Issue Instances</button>
		</div>

		<section 
			id="tabpanel-1" 
			tabindex="0"
			role="tabpanel" 
			aria-labelledby="issuesTab">
			<div class="canvas-wrapper issues-chart">
				<div style="height: 400px; width: 100%;">
					<canvas id="issues-chart" style="height: 400px; width:100%;"></canvas>
				</div>
			</div>
  	</section>

		<section 
			id="tabpanel-2" 
			tabindex="0"
			role="tabpanel" 
			aria-labelledby="instancesTab">
			<div class="canvas-wrapper instances-chart">
				<div style="height: 400px; width: 100%;">
					<canvas id="instances-chart" style="height: 400px; width:100%;"></canvas>
				</div>
			</div>
  	</section>
	</div>
</div>

	<script>

		// Tab controls
		window.addEventListener("DOMContentLoaded", () => {
			const tabList = document.querySelector('[role="tablist"]');
			const tabs = tabList.querySelectorAll('[role="tab"]');
			const tabSections = document.querySelectorAll('[role="tabpanel"]');
			
			// Add a click event handler to each tab
			tabs.forEach((tab) => {
				tab.addEventListener("click", changeTabs);
			});

			// find active tab
			const activeTab = tabList.querySelector('[aria-selected="true"]');
			const activePanel = document.getElementById(activeTab.getAttribute("aria-controls"));
			
			// now hide all tab panels
			tabSections.forEach((p) => {
					if (p !== activePanel) 
						p.setAttribute("hidden", true)
				});

			let tabFocus = 0;

			tabList.addEventListener("keydown", (e) => {
				if (e.key === "ArrowRight" || e.key === "ArrowLeft") {
					tabs[tabFocus].setAttribute("tabindex", -1);
					if (e.key === "ArrowRight") {
						e.preventDefault();
						tabFocus++;
						if (tabFocus >= tabs.length) {
							tabFocus = 0;
						}
					} else if (e.key === "ArrowLeft") {
						tabFocus--;
						if (tabFocus < 0) {
							tabFocus = tabs.length - 1;
						}
					}

					tabs[tabFocus].setAttribute("tabindex", 0);
					tabs[tabFocus].focus();
					tabs[tabFocus].click();
				}
			});
		});

		function changeTabs(e) {
			const targetTab = e.target;
			const tabList = targetTab.parentNode;
			const tabGroup = tabList.parentNode;
			
			tabList
				.querySelectorAll('[aria-selected="true"]')
				.forEach((t) => t.setAttribute("aria-selected", false));

			targetTab.setAttribute("aria-selected", true);

			tabGroup
				.querySelectorAll('[role="tabpanel"]')
				.forEach((p) => p.setAttribute("hidden", true));

			tabGroup
				.querySelector(`#${targetTab.getAttribute("aria-controls")}`)
				.removeAttribute("hidden");
		}

		document.addEventListener('DOMContentLoaded', function() {
			const issuesChartData = <?php echo json_encode( $response['meta']['issues_chart']['chartData'] ); ?>;
			const issuesChartOptions = <?php echo json_encode( $response['meta']['issues_chart']['options'] ); ?>;

			const instancesChartData = <?php echo json_encode( $response['meta']['instances_chart']['chartData'] ); ?>;
			const instancesChartOptions = <?php echo json_encode( $response['meta']['instances_chart']['options'] ); ?>;
			
			issuesChartData.datasets[0].label = 'Issues';
			instancesChartData.datasets[0].label = 'Issue Instances';

			const issueCtx = document.getElementById('issues-chart').getContext('2d');
			const instanceCtx = document.getElementById('instances-chart').getContext('2d');

			const issueChart = new Chart(issueCtx, {
				type: 'line',
				data: issuesChartData,
				issuesChartOptions
			});
			const instanceChart = new Chart(instanceCtx, {
				type: 'line',
				data: instancesChartData,
				instancesChartOptions
			});
			
		});
	</script>
