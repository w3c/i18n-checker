# W3C's i18n Checker

This checker performs various tests on a Web Page to determine its level of internationalisation-friendliness. It also summarises key internationalization information about a page, such as character encoding and language declarations, etc.

See the latest released version of the checker at
https://validator.w3.org/i18n-checker/

The checks run by the currently released version of the checker are documented at https://www.w3.org/International/quicktips/doc/checker.

This software is free/open source, licensed under the terms of the [W3C software licence](https://github.com/w3c/i18n-checker/blob/main/LICENSE.html).

There is a set of [installation notes](https://github.com/w3c/i18n-checker/wiki/Installation-notes) for those who want to work with the source code.

Proposals for changes to the checker must be submitted via pull requests, and will need to be reviewed by someone other than the proposer before merging with the main branch. The file `www/test.php` should be run before submitting a pull request, to ensure that the changes don't break existing tests.

## Local development

1. Create a local configuration file:

   ```sh
   cp conf/i18n.conf.dist conf/i18n.conf
   ```

2. If you use PHP's built-in server, update `test_url` in `conf/i18n.conf` to:

   ```ini
   test_url="http://localhost:8000/tests/generate.php"
   ```

3. Start a local server from the repository root:

   ```sh
   php -S localhost:8000 -t .
   ```

4. Open the application at `http://localhost:8000/www/index.php`.

## Repository layout

- `src/` contains the checker logic.
- `www/` contains the web entry points and static assets.
- `templates/` contains the HTML/XML presentation templates.
- `langs/*.properties` contains UI and report strings. `langs/en.properties` is
  the canonical source for new messages.
- `tests/` contains generated test fixtures and expected regression results.
- `lib/` contains vendored third-party code.
