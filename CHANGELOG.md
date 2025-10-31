# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Fixed
- Fixed namespace issues in Datatable and ModelDoesntExist exception
- Corrected exception imports to use Tresorkasenda namespace

### Added
- Complete MIT License documentation
- Comprehensive CHANGELOG documentation
- PHPDoc documentation for exception classes

## [Latest] - 2024-10-31

### Fixed
- Code review and improvements in forms components
- Updated composer dependencies

### Changed
- Updated Composer configuration
- Updated service provider

### Added
- Route creation ability for components
- Artisan commands to generate:
  - Forms (create and edit)
  - Models
  - Migrations
  - Seeders
  - Factories

## Previous Releases

### Added
- Initial release with core features:
  - Form components (TextInput, SelectInput, DatePicker, etc.)
  - Datatable component with sorting and pagination
  - Wizard component for multi-step forms
  - Widget components (Card, FullCalendar, ListGroup)
  - Chart components (ApexChart integration)
  - Modal and Dropdown components
  - BallStack installation command
  - Support for Laravel 10.48+ and 11.0+
  - Integration with Livewire 3
  - Alpine.js integration
  - Bootstrap 5 support
  - OAuth integration (Facebook, Google, GitHub)

### Features
- Email notifications when user account is created
- Livewire 3 compatibility
- Code linting with Laravel Pint
- Static analysis with Larastan
- Test support with Pest and PHPUnit

---

[Unreleased]: https://github.com/Tresor-Kasenda/ballstack/compare/main...HEAD
[Latest]: https://github.com/Tresor-Kasenda/ballstack/releases/latest
