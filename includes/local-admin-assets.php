<?php
/**
 * Local administration presentation hardening.
 *
 * @package AI_Search_Optimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Provides the local admin hardening styles operation.
 */
function kairoseth_aiwr_local_admin_hardening_styles() {
	?>
	<style id="ai-search-optimizer-admin-hardening">
		.ai-search-optimizer-local,
		.ai-search-optimizer-lifecycle {
			box-sizing: border-box;
			max-width: 100%;
		}

		.ai-search-optimizer-local *,
		.ai-search-optimizer-lifecycle * {
			box-sizing: border-box;
		}

		.ai-search-optimizer-local .widefat {
			width: 100%;
			max-width: 1100px;
			table-layout: fixed;
		}

		.ai-search-optimizer-local .widefat th,
		.ai-search-optimizer-local .widefat td,
		.ai-search-optimizer-local .aiso-meta,
		.ai-search-optimizer-local code,
		.ai-search-optimizer-local a {
			overflow-wrap: anywhere;
			word-break: break-word;
		}

		.ai-search-optimizer-local textarea {
			max-width: 100%;
			resize: vertical;
		}

		.ai-search-optimizer-local .button:focus-visible,
		.ai-search-optimizer-lifecycle .button:focus-visible,
		.ai-search-optimizer-local input[type="checkbox"]:focus-visible,
		.ai-search-optimizer-lifecycle input[type="radio"]:focus-visible,
		.ai-search-optimizer-local a:focus-visible,
		.ai-search-optimizer-lifecycle a:focus-visible {
			outline: 2px solid currentColor;
			outline-offset: 2px;
			box-shadow: none;
		}

		@media screen and (max-width: 782px) {
			.ai-search-optimizer-local,
			.ai-search-optimizer-lifecycle {
				width: 100%;
				padding-right: 10px;
			}

			.ai-search-optimizer-local .aiso-grid {
				grid-template-columns: minmax(0, 1fr) !important;
			}

			.ai-search-optimizer-local .aiso-card,
			.ai-search-optimizer-lifecycle fieldset,
			.ai-search-optimizer-lifecycle .notice {
				max-width: 100%;
			}

			.ai-search-optimizer-local .widefat {
				display: block;
				width: 100%;
				max-width: 100%;
				overflow-x: auto;
				-webkit-overflow-scrolling: touch;
			}

			.ai-search-optimizer-local .widefat th,
			.ai-search-optimizer-local .widefat td {
				min-width: 120px;
			}

			.ai-search-optimizer-local .widefat .aiso-checkbox {
				min-width: 72px;
				width: 72px;
			}

			.ai-search-optimizer-local .aiso-meta {
				display: grid !important;
				grid-template-columns: minmax(0, 1fr);
				gap: 6px !important;
			}

			.ai-search-optimizer-local .aiso-actions {
				align-items: stretch !important;
			}

			.ai-search-optimizer-local .aiso-actions .button,
			.ai-search-optimizer-lifecycle .button-primary {
				min-height: 44px;
				height: auto;
				white-space: normal;
			}

			.ai-search-optimizer-local textarea {
				min-height: 260px !important;
				font-size: 13px;
			}
		}
	</style>
	<?php
}

if ( PHP_SAPI !== 'cli' ) {
	add_action( 'admin_head-tools_page_ai-search-optimizer', 'kairoseth_aiwr_local_admin_hardening_styles' );
	add_action( 'admin_head-tools_page_ai-search-optimizer-data', 'kairoseth_aiwr_local_admin_hardening_styles' );
}
