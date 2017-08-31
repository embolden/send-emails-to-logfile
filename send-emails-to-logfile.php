<?php
/**
 * Plugin Name: Send Emails to Logfile
 * Description: Writes wp_mail calls to a mail.log file in wp-content
 * Version: 0.1.0
 * Author: Matt Keehner
 */

/**
 * Undocumented function
 *
 * @param [type] $to
 * @param [type] $subject
 * @param [type] $message
 * @param string $headers
 * @param array $attachments
 * @return void
 */
if( ! function_exists( 'wp_mail' ) ) {
	function wp_mail( $to, $subject, $message, $headers = '', $attachments = array() ) {
		$filename = WP_CONTENT_DIR . '/mail.log';
		$flags    = FILE_APPEND;

		$data  = "To: $to \n";
		$data .= "Subject: $subject \n";
		$data .= "Message: $message \n";
		if ( ! empty( $headers ) ) {
			$data .= "Header: " . print_r( $headers, true ) . "\n";
		}
		if( ! empty( $attachments ) ) {
			$data .= "Attachments: " . print_r( $attachments, true ) . "\n";
		}

		return (bool) file_put_contents( $filename, $data, $flags );
	}
}
