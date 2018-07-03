# lib-arcanist-eslint-extension

This library integrates [ESLint](https://github.com/eslint/eslint) as lint engine to `arcanist`.
It allows developer to automatically run `eslint` on `arc diff`.

### Before installing library

To automatically configure your `.arcconfig` and `.arclint` add `"Paysera\\Composer\\ArcanistEslintExtensionConfigurator::configure"` script to `post-install-cmd` and `post-update-cmd`
 or other `scipts` - just make sure this script is executed on `composer install`.
 
 ### Installation
 
 * `composer require --dev paysera/lib-arcanist-eslint-extension`.
 * Make sure `.arcconfig` file contains following configurable default entries:
   * `"load": ["vendor/paysera/lib-arcanist-eslint-extension/src"]` There also can be more than one loadable linter in the array
   