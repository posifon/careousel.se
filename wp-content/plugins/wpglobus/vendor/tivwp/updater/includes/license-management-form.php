<?php
/**
 * View: License management form.
 *
 * @package TIVWP_Updater
 *
 * @var TIVWP_Updater $this
 */

$_slug = sanitize_title( $this->slug );
?>

<tr class="active tivwp-updater tivwp-updater-status-<?php echo esc_attr( $this->status ); ?>">
	<th scope="row" class="check-column">&nbsp;</th>
	<td class="plugin-title column-primary">
		<div class="tivwp-updater-status"><i class="dashicons-before dashicons-arrow-up-alt"></i>
			<?php esc_html_e( 'Updates', 'tivwp-updater' ); ?>:
			<span class="tivwp-updater-status-value">
				<?php echo esc_html( $this->status ); ?>
				</span>
		</div>
		<div class="tivwp-updater-instance">
			<?php esc_html_e( 'Instance', 'tivwp-updater' ); ?>:
			<?php echo esc_html( $this->instance ); ?>
		</div>
		<button type="submit"
		        class="tivwp-updater-action-button"
		        data-tivwp-updater-slug="<?php echo esc_attr( $_slug ); ?>"
		        name="<?php echo esc_attr( $_slug ); ?>_action"
		        value="status">
			<?php esc_html_e( 'Check Status', 'tivwp-updater' ); ?>
		</button>
	</td>
	<td class="column-description desc">
		<?php if ( 'active' !== $this->status ) : ?>
			<div class="plugin-description">
				<p>
					<?php esc_html_e( 'A current subscription is required for updates.', 'tivwp-updater' ); ?>
					|
					<a href="<?php echo esc_url( $this->url_product ); ?>">
						<?php esc_html_e( 'Purchase or renew here.', 'tivwp-updater' ); ?>
					</a>
				</p>
			</div>
		<?php endif; ?>
		<div>
			<label for="<?php echo esc_attr( $_slug ); ?>_licence_key">
				<?php esc_html_e( 'Key' ); ?>:
			</label>
			<input type="text" id="<?php echo esc_attr( $_slug ); ?>_licence_key"
			       name="<?php echo esc_attr( $_slug ); ?>_licence_key"
			       value="<?php echo esc_attr( $this->licence_key ); ?>"
				<?php disabled( 'active' === $this->status && $this->licence_key ); ?>
			/>
			<label for="<?php echo esc_attr( $_slug ); ?>_email">
				<?php esc_html_e( 'Email' ); ?>:
			</label>
			<input type="email" id="<?php echo esc_attr( $_slug ); ?>_email"
			       name="<?php echo esc_attr( $_slug ); ?>_email"
			       value="<?php echo esc_attr( $this->email ); ?>"
				<?php disabled( 'active' === $this->status && $this->email ); ?>
			/>
			<?php
			$_action       = ( 'active' === $this->status ? 'deactivate' : 'activate' );
			$_action_label = ( 'active' === $this->status
				? __( 'Deactivate' )
				: __( 'Activate' )
			);
			?>
			<button type="submit"
			        class="tivwp-updater-action-button"
			        data-tivwp-updater-slug="<?php echo esc_attr( $_slug ); ?>"
			        name="<?php echo esc_attr( $_slug ); ?>_action"
			        value="<?php echo esc_attr( $_action ); ?>">
				<?php echo esc_html( $_action_label ); ?>
			</button>
			<?php

			?>
		</div>
		<?php
		if ( $this->notifications ) {
			?>
			<div class="tivwp-updater-notifications"><?php
			echo wp_kses( implode( '<br>', $this->notifications ), array( 'br' => array() ) );
			?></div><?php
		}
		?>
	</td>
</tr>
