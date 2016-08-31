# W3C's i18n Checker 

This checker performs various tests on a Web Page to determine its level of internationalisation-friendliness. It also summarises key internationalization information about a page, such as character encoding and language declarations, etc.

See the latest released version of the checker at
https://validator.w3.org/i18n-checker/

The checker is also integrated into Unicorn.

The checks run by the currently released version of the checker are documented at https://www.w3.org/International/quicktips/checker. Tests run by the version of the checker in development (ie. the code in this github repository) are documented at https://www.w3.org/International/quicktips/doc/checker.

Proposals for changes to the checker must be submitted via pull requests, and will need to be reviewed by someone other than the proposer before merging with the master branch. The file tests/index.php should be run before submitting a pull request, to ensure that the changes don't break existing tests. 

When submitting a pull requests for a new check, you should 

1. add new tests for that check in tests/data.php
2. add calls to those tests to tests/index.php, and ensure that none of the previous tests break
3. add the check to doc/checker.en.php
4. add parsed data that may be useful elsewhere to the class.Parser.php file, but add the actual test to class.Checker.php
5. add the full set of messages and links needed for the report to langs/en.properties


