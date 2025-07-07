# W3C's i18n Checker

This checker performs various tests on a Web Page to determine its level of internationalisation-friendliness. It also summarises key internationalization information about a page, such as character encoding and language declarations, etc.

See the latest released version of the checker at
https://validator.w3.org/i18n-checker/

The checks run by the currently released version of the checker are documented at https://www.w3.org/International/quicktips/doc/checker.

This software is free/open source, licensed under the terms of the [W3C software licence](https://github.com/w3c/i18n-checker/blob/main/LICENSE.html).

There is a set of [installation notes](https://github.com/w3c/i18n-checker/wiki/Installation-notes) for those who want to work with the source code.

Proposals for changes to the checker must be submitted via pull requests, and will need to be reviewed by someone other than the proposer before merging with the main branch. The file `www/test.php` should be run before submitting a pull request, to ensure that the changes don't break existing tests.

When submitting a pull requests for a new check, you should

1. add new tests for that check in tests/data.php
2. add calls to those tests to `www/test.php`, and ensure that none of the previous tests break
3. add the check to doc/checker.en.php
4. add parsed data that may be useful elsewhere to the class.Parser.php file, but add the actual test to class.Checker.php
5. add the full set of messages and links needed for the report to langs/en.properties
