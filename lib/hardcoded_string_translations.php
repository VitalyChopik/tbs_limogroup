<?php

function register_hardcoded_strings()
{
    $string_translations = [
        'tribusoft_limogroup' => [
            'Our mission is to provide the customer with a comfortable and smooth ride with a sense of luxury and exclusivity',
            'Limogroup i sociala media',
            'Vi vill ha en nära relation med våra kunder. Du hittar oss i de flesta sociala kanalerna',
            'Request a callback',
            'KONTAKT',
            'Phone',
            'Du når oss på',
            'Address',
        ]
    ];

	foreach ($string_translations as $domain => $strings) {
        $index = 0;
		foreach ($strings as $string) {
            $index++;
			do_action('wpml_register_single_string', $domain, "$domain - $index", $string);
		}
	}
}
register_hardcoded_strings();