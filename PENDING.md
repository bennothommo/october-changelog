# Pending changes for release

## Enhancements and New Features
- Halcyon DbDatasource ([library#356](https://github.com/octobercms/library/pull/356))

## API and Feature Changes
- Accessibility enhancement for code editor icons ([october#4395](https://github.com/octobercms/october/pull/4395))
- Fix selection issue for similar-named CMS objects ([october#4433](https://github.com/octobercms/october/pull/4433))
- Make plugin dependency checks case-insensitive ([october#4337](https://github.com/octobercms/october/pull/4337))
- Add additional test cases for PluginManager ([october#4427](https://github.com/octobercms/october/pull/4427))
- Fix support for custom Select2 options via the AJAX framework ([october#4414](https://github.com/octobercms/october/pull/4414))
- Clean up index functionality in Repeater widget ([october#4424](https://github.com/octobercms/october/pull/4424))
- Improved Brazilian Portuguese translation ([october#4415](https://github.com/octobercms/october/pull/4415))
- Block off SW running in backend and reduce lookups ([october#4385](https://github.com/octobercms/october/pull/4385))
- Add exceptions to PHPCS as per developer guide ([october#4434](https://github.com/octobercms/october/pull/4434))
- Fix code coverage test for single commits ([october#4434](https://github.com/octobercms/october/pull/4434))
- Fix Travis CI file scope ([october#4408](https://github.com/octobercms/october/pull/4408))
- Improve Travis CI build process ([october#4394](https://github.com/octobercms/october/pull/4394))
- Retain support for PHP < 7.3, fixes #4405 ([october#4434](https://github.com/octobercms/october/pull/4434))
- Typo fix ([october#4434](https://github.com/octobercms/october/pull/4434))
- Improve support for protected files on S3 ([october#4390](https://github.com/octobercms/october/pull/4390))
- Fix FormData initialization ([october#4391](https://github.com/octobercms/october/pull/4391))
- Add preview mode for taglist widget ([october#4349](https://github.com/octobercms/october/pull/4349))
- Add new Performance API's to October CMS ([october#4285](https://github.com/octobercms/october/pull/4285))
- Improve API docs ([october#4434](https://github.com/octobercms/october/pull/4434))
- Fix error messages in RelationController ([october#4434](https://github.com/octobercms/october/pull/4434))
- Use default options when generating thumbnails for private files ([october#4353](https://github.com/octobercms/october/pull/4353))
- Hide popup loading indicator if an error/flash is thrown from an AJAX handler ([october#4364](https://github.com/octobercms/october/pull/4364))
- Fix: Hard-coded URL in ControllerTest::testThemeUrl ([october#4378](https://github.com/octobercms/october/pull/4378))
- Add tests for optional wildcard ([october#3964](https://github.com/octobercms/october/pull/3964))
- Update path to video-poster.png ([october#4240](https://github.com/octobercms/october/pull/4240))
- Remove typehints for database template methods. ([october#4434](https://github.com/octobercms/october/pull/4434))
- Store limited list widget configuration in user preferences ([october#4360](https://github.com/octobercms/october/pull/4360))
- Fix empty menu item counter ([october#4374](https://github.com/octobercms/october/pull/4374))
- Support environment variable for database templates ([october#4434](https://github.com/octobercms/october/pull/4434))
- Fix menus not being displayed with database templates ([october#4362](https://github.com/octobercms/october/pull/4362))
- Fix: Apply custom secondary color to Pages list ([october#4355](https://github.com/octobercms/october/pull/4355))
- Fix: Restore FroalaEditor extendability ([october#4356](https://github.com/octobercms/october/pull/4356))
- Use temporaryUrls for protected files if the storage driver supports them.  ([october#4358](https://github.com/octobercms/october/pull/4358))
- Compile rich editor with inline style and class ([october#4434](https://github.com/octobercms/october/pull/4434))
- Database layer for the CMS objects ([october#3908](https://github.com/octobercms/october/pull/3908))
- Fixed support for Auth::id() ([library#412](https://github.com/octobercms/library/pull/412))
- Fix: Don't minify css rules inside parentheses ([library#411](https://github.com/octobercms/library/pull/411))
- Don't minify css rules inside parentheses ([library#411](https://github.com/octobercms/library/pull/411))
- Prevent double decoding of jsonable attributes ([library#405](https://github.com/octobercms/library/pull/405))
- Improve Halcyon model AddDynamicPoperty test ([library#408](https://github.com/octobercms/library/pull/408))
- Various improvements to File handling logic.  ([library#406](https://github.com/octobercms/library/pull/406))

## Other changes
- Fix typo ([october@`7782e04e`](https://github.com/octobercms/october/commit/7782e04ef8267d366c2ad0e30398ce58bc0cd400))
- Disable searching and sorting on any_template ([october@`e0e951df`](https://github.com/octobercms/october/commit/e0e951dfcd4ee3b1b7b40546f7f4fe3d7dfb994e))
- Remove support for invalid relation type column ([october@`029a2998`](https://github.com/octobercms/october/commit/029a299816f7a726c9eeb4adb70fd18d1db4f533))
- Only attempt to translate string values ([october@`f9f337e6`](https://github.com/octobercms/october/commit/f9f337e6646d60c689d3f56595b2227b3df248cf))
- Disable theme config cache when debug mode enabled ([october@`6f583b39`](https://github.com/octobercms/october/commit/6f583b392077e31fbdd7566634ec65515bfbc98a))
- Fix code quality errors in Lists widget ([october@`be2a8507`](https://github.com/octobercms/october/commit/be2a850787d5564445b3c946f20415e0ab22b208))
- Increment column count when tree is shown ([october@`c1dcc625`](https://github.com/octobercms/october/commit/c1dcc6255914d3fd216165579e0a067d6f816803))
- minor code cleanup ([library@`3e6f66cf`](https://github.com/octobercms/library/commit/3e6f66cfafe9d09f45594cda87744531b410386d))
- Improve error message when not using directories in custom Halcyon models. ([library@`0b50bb4e`](https://github.com/octobercms/library/commit/0b50bb4ef6f2294def6f9191808f16a95effacc0))

---

We would like to thank the following people for their contributions to this release:

- **@Air-Petr**
- **@ayumihamsaki**
- **@bennothommo**
- **@daftspunk**
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