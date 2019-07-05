# Pending changes for release

## Enhancements and New Features
- Add new Performance API's to October CMS ([october#4285](https://github.com/octobercms/october/pull/4285))
- Store limited list widget configuration in user preferences ([october#4360](https://github.com/octobercms/october/pull/4360))
- Use temporaryUrls for protected files if the storage driver supports them.  ([october#4358](https://github.com/octobercms/october/pull/4358))
- Database layer for the CMS objects ([october#3908](https://github.com/octobercms/october/pull/3908))
- Halcyon DbDatasource ([library#356](https://github.com/octobercms/library/pull/356))

## API and Feature Changes
- Make plugin dependency checks case-insensitive ([october#4337](https://github.com/octobercms/october/pull/4337))
- Add additional test cases for PluginManager ([october#4427](https://github.com/octobercms/october/pull/4427))
- Fix support for custom Select2 options via the AJAX framework ([october#4414](https://github.com/octobercms/october/pull/4414))
- Clean up index functionality in Repeater widget ([october#4424](https://github.com/octobercms/october/pull/4424))
- Improved Brazilian Portuguese translation ([october#4415](https://github.com/octobercms/october/pull/4415))
- Block off SW running in backend and reduce lookups ([october#4385](https://github.com/octobercms/october/pull/4385))
- Fix Travis CI file scope ([october#4408](https://github.com/octobercms/october/pull/4408))
- Improve Travis CI build process ([october#4394](https://github.com/octobercms/october/pull/4394))
- Fix FormData initialization ([october#4391](https://github.com/octobercms/october/pull/4391))
- Add preview mode for taglist widget ([october#4349](https://github.com/octobercms/october/pull/4349))
- Use default options when generating thumbnails for private files ([october#4353](https://github.com/octobercms/october/pull/4353))
- Hide popup loading indicator if an error/flash is thrown from an AJAX handler ([october#4364](https://github.com/octobercms/october/pull/4364))
- Fix: Hard-coded URL in ControllerTest::testThemeUrl ([october#4378](https://github.com/octobercms/october/pull/4378))
- Add tests for optional wildcard ([october#3964](https://github.com/octobercms/october/pull/3964))
- Update path to video-poster.png ([october#4240](https://github.com/octobercms/october/pull/4240))
- Fix empty menu item counter ([october#4374](https://github.com/octobercms/october/pull/4374))
- Fix: Apply custom secondary color to Pages list ([october#4355](https://github.com/octobercms/october/pull/4355))
- Fix: Restore FroalaEditor extendability ([october#4356](https://github.com/octobercms/october/pull/4356))
- Prevent double decoding of jsonable attributes ([library#405](https://github.com/octobercms/library/pull/405))
- Improve Halcyon model AddDynamicPoperty test ([library#408](https://github.com/octobercms/library/pull/408))
- Various improvements to File handling logic.  ([library#406](https://github.com/octobercms/library/pull/406))

## Bug fixes
- Fix selection issue for similar-named CMS objects ([october#4433](https://github.com/octobercms/october/pull/4433))
- Improve support for protected files on S3 ([october#4390](https://github.com/octobercms/october/pull/4390))
- Fix menus not being displayed with database templates ([october#4362](https://github.com/octobercms/october/pull/4362))

## Other changes
- Add exceptions to PHPCS as per developer guide ([october@`53a82522`](https://github.com/octobercms/october/commit/53a825222d190040c9efb04d47336ce82ed5ba1c))
- Fix code coverage test for single commits ([october@`8d02c5e9`](https://github.com/octobercms/october/commit/8d02c5e935626d525530d3da70f6df34d1f20bfa))
- Retain support for PHP < 7.3, fixes #4405 ([october@`ae7da9f9`](https://github.com/octobercms/october/commit/ae7da9f9578ad67bd9f6358126c796a773da965a))
- Typo fix ([october@`a1b10180`](https://github.com/octobercms/october/commit/a1b101808356b431069b2dd5168bd9eeb51104d9))
- Improve API docs ([october@`46c867e4`](https://github.com/octobercms/october/commit/46c867e4b5a5f7f9fc6e09eb8a146878bec319f4))
- Fix error messages in RelationController ([october@`71241ee6`](https://github.com/octobercms/october/commit/71241ee6d4d308a37873c123a49cf903ca011ed7))
- Remove typehints for database template methods. ([october@`a777c44c`](https://github.com/octobercms/october/commit/a777c44cb43a4a53882103dc9904cf18c67ba11b))
- Support environment variable for database templates ([october@`8768e0a5`](https://github.com/octobercms/october/commit/8768e0a54c02562889f0781c55379f010256585a))
- Compile rich editor with inline style and class ([october@`1ad43554`](https://github.com/octobercms/october/commit/1ad43554d4ad937a4264472138827ad799f3be1c))
- minor code cleanup ([library@`3e6f66cf`](https://github.com/octobercms/library/commit/3e6f66cfafe9d09f45594cda87744531b410386d))
- Improve error message when not using directories in custom Halcyon models. ([library@`0b50bb4e`](https://github.com/octobercms/library/commit/0b50bb4ef6f2294def6f9191808f16a95effacc0))

---

We would like to thank the following people for their contributions to this release:

- **@Air-Petr**
- **@ayumihamsaki**
- **@bennothommo**
- **@daftspunk**
- **@DanHarrin**
- **@fansaien**
- **@gergo85**
- **@LarBearrr**
- **@LukeTowers**
- **@mariavilaro**
- **@mjauvin**
- **@panakour**
- **@prhost**
- **@Rike-cz**
- **@SebastiaanKloos**
- **@tobias-kuendig**
- **@VoroninWD**
- **@w20k**
- **@wenlong-date**