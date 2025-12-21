<?php
/**
 * LC Schema Markup
 *
 * Custom schema markup for LocalBusiness + opening hours.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

// Disable Yoast's organization schema completely.
add_filter( 'wpseo_schema_organization', '__return_false' );
add_filter( 'wpseo_schema_company_logo_id', '__return_false' );

/**
 * Clean Yoast schema for MJP.
 *
 * Removes Yoast's Organization and Person pieces,
 * and rewrites all Yoast references so they point
 * to the business entity (#business).
 */
add_filter(
	'wpseo_schema_graph_pieces',
	function ( $pieces, $context ) {

		foreach ( $pieces as $index => $piece ) {

			// Remove Yoast Organisation.
			if ( $piece instanceof \Yoast\WP\SEO\Generators\Schema\Organization ) {
				unset( $pieces[ $index ] );
				continue;
			}

			// Remove Yoast Person (author schema).
			if ( $piece instanceof \Yoast\WP\SEO\Generators\Schema\Person ) {
				unset( $pieces[ $index ] );
				continue;
			}

			// Remove WebPage schema on contact page.
			if ( is_page( 'contact' ) && $piece instanceof \Yoast\WP\SEO\Generators\Schema\WebPage ) {
				unset( $pieces[ $index ] );
				continue;
			}

			// Rewrite Yoast WebPage and WebSite references.
			if ( method_exists( $piece, 'context' ) ) {
				$context_data = $piece->context;

				// Replace Yoast's #organization ID with your #business ID.
				if ( isset( $context_data['id'] ) && str_contains( $context_data['id'], '#organization' ) ) {
					$context_data['id'] = home_url( '/#business' );
				}

				// Rewrite publisher.
				if ( isset( $context_data['publisher'] ) &&
					isset( $context_data['publisher']['@id'] ) &&
					str_contains( $context_data['publisher']['@id'], '#organization' )
				) {
					$context_data['publisher']['@id'] = home_url( '/#business' );
				}

				// Rewrite about → #business.
				if ( isset( $context_data['about'] ) &&
					isset( $context_data['about']['@id'] ) &&
					str_contains( $context_data['about']['@id'], '#organization' )
				) {
					$context_data['about']['@id'] = home_url( '/#business' );
				}

				// Push changes back into piece.
				$piece->context = $context_data;
			}
		}

		return $pieces;
	},
	20,
	2
);

/**
 * Output schema markup for the site.
 *
 * @return void
 */
function lc_output_schema() {
	if ( is_front_page() || is_home() ) {

		// ORGANIZATION SCHEMA.
		$schema = array(
			'@context' => 'https://schema.org',
			'@type'    => get_field( 'schema_business_type', 'options' ) ? get_field( 'schema_business_type', 'options' ) : 'ProfessionalService',
			'@id'      => home_url( '/#business' ),
			'name'     => get_bloginfo( 'name' ),
			'url'      => home_url( '/' ),
		);
		// Add description.
		$description = get_bloginfo( 'description' );
		if ( $description ) {
			$schema['description'] = $description;
		}

		// Add logo.
		$logo = get_field( 'schema_logo', 'options' );
		if ( $logo ) {
			$schema['logo']  = $logo;
			$schema['image'] = $logo;
		}

		// Add phone.
		$telephone = get_field( 'contact_phone', 'options' );
		if ( $telephone ) {
			$schema['telephone'] = $telephone;
		}

		// Add address if all required fields present.
		$street_address = get_field( 'schema_street_address', 'options' );
		$locality       = get_field( 'schema_locality', 'options' );
		$postal_code    = get_field( 'schema_postal_code', 'options' );

		if ( $street_address && $locality && $postal_code ) {
			$schema['address'] = array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $street_address,
				'addressLocality' => $locality,
				'postalCode'      => $postal_code,
				'addressCountry'  => 'GB',
			);
		}

		// Add coordinates if both present.
		$latitude  = get_field( 'schema_latitude', 'options' );
		$longitude = get_field( 'schema_longitude', 'options' );

		if ( $latitude && $longitude ) {
			$schema['geo'] = array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => (float) $latitude,
				'longitude' => (float) $longitude,
			);
		}

		// Add price range.
		$price_range = get_field( 'schema_price_range', 'options' );
		if ( $price_range ) {
			$schema['priceRange'] = $price_range;
		}

		// Add map if available.
		$map_embed = get_field( 'map_embed_code', 'options' );
		if ( $map_embed ) {
			$schema['hasMap'] = $map_embed;
		}

		// Add social media links.
		$social = get_field( 'social', 'options' );
		if ( $social && is_array( $social ) ) {
			$same_as = array();
			foreach ( array( 'facebook_url', 'instagram_url', 'twitter_url', 'linkedin_url', 'youtube_url' ) as $key ) {
				if ( ! empty( $social[ $key ] ) ) {
					$same_as[] = $social[ $key ];
				}
			}
			if ( ! empty( $same_as ) ) {
				$schema['sameAs'] = $same_as;
			}
		}

		// Add opening hours from plugin if available.
		if ( function_exists( 'get_opening_hours_specification_array' ) ) {
			$opening_hours = get_opening_hours_specification_array();
			if ( ! empty( $opening_hours ) ) {
				$schema['openingHoursSpecification'] = $opening_hours;
			}
		}

		echo '<script type="application/ld+json">';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
		echo '</script>';
	}

	// Check for custom schema first (works on all pages including contact).
	if ( function_exists( 'get_field' ) ) {
		$custom_schema = get_field( 'schema' );
		if ( ! empty( $custom_schema ) ) {
			// Decode to validate JSON, then re-encode for consistent output.
			$schema_data = json_decode( $custom_schema, true );
			if ( json_last_error() === JSON_ERROR_NONE && is_array( $schema_data ) ) {
				echo '<script type="application/ld+json">';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo wp_json_encode( $schema_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
				echo '</script>';
				return;
			}
		}
	}

	// Fallback contact page schema if no custom schema defined.
	if ( is_page( 'contact' ) ) {
		$contact_schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'ContactPage',
			'name'     => 'Contact ' . get_bloginfo( 'name' ),
			'url'      => get_permalink(),
			'about'    => array(
				'@id' => home_url( '/#business' ),
			),
		);
		echo '<script type="application/ld+json">';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo wp_json_encode( $contact_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
		echo '</script>';
	}
}
add_action( 'wp_head', 'lc_output_schema', 5 );
