# WP I18n

[![Build Status](https://travis-ci.org/wp-oop/wp-i18n.svg?branch=develop)](https://travis-ci.org/wp-oop/wp-i18n)
[![Code Climate](https://codeclimate.com/github/wp-oop/wp-i18n/badges/gpa.svg)](https://codeclimate.com/github/wp-oop/wp-i18n)
[![Test Coverage](https://codeclimate.com/github/wp-oop/wp-i18n/badges/coverage.svg)](https://codeclimate.com/github/wp-oop/wp-i18n/coverage)
[![Latest Stable Version](https://poser.pugx.org/wp-oop/wp-i18n/version)](https://packagist.org/packages/wp-oop/wp-i18n)

## Internationalization for WP
Conventional WordPress means of i18n prevent us from writing good code. What this package solves:

- Use Dependency Injection, and avoid global state.
- De-couple your code from the global `__()` function, and thus from WP itself.
- Remove the duplicate hard-coded text domain; instead, centralize it, and de-couple consuming logic from it.
- Use a standards-compliant mechanism, while continuig to use the same familiar gettext tools, like Poedit.
- Make your code more testable.

For more information about the how and why, please see the [Wiki documentation][docs].

[docs]: https://github.com/Dhii/wp-i18n/wiki
