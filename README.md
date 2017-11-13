# Fibonacci

Demonstrates the technical aspects of my speech about the transition from Wordpress AJAX endpoints to Rest API.

You need to install the vendor packages with `composer install --no-dev` if you want to use this plugin.

- Ativate the plugin in the WordPress admin
- Open the JavaScript console or Code Inspector in your browser
- You will see the confermation that a sequence was created
- on "Return" you will go ahead with the next number in the sequence
- on "Esc" the sequence will be halted/deleted

## Tests

There are some unit tests available. Just run `composer install` in your shell. This will install everything you need for unit testing. Afterwards just call `phpunit`.
