# Changelog

## [0.22.3] - 2023-04-14

### Fixed
- fixed bug in mmenu logo


## [0.22.2] - 2023-04-14

### Added
- option to add logo to mmenu


## [0.22.1] - 2023-02-01

### Added
- mmenu added to codepen


## [0.22.0] - 2023-01-24

### Added
- mmenu generator

### Fixed
- Codeview preview min-height increased


## [0.21.3] - 2022-11-23

### Added
- Add CC field to feedback form


## [0.21.2] - 2022-11-23

### Fixed
- Fixed JS issue on feedback form


## [0.21.1] - 2022-11-23

### Fixed
- Fixed ID issue on feedback form


## [0.21.0] - 2022-11-23

### Added
- Added generator for feedback form


## [0.20.1] - 2022-10-05

### Added
- Added responsive controls for codeview

### Changed
- Jobposting employmentType is now multiselect
- Jobposting generator checks required fields
- Changed Jobposting addressRegion to addressCountry
- Automatically set postdate in Jobposting to current date


## [0.20.0] - 2022-09-23

### Added
- Added swiper to codepen


## [0.19.3] - 2022-08-22

### Changed
- Update script placement in mapgenerator


## [0.19.2] - 2022-08-22

### Changed
- Update Mapgenerator to use CCM


## [0.19.1] - 2022-05-11

### Changed
- FAQ Styling


## [0.19.0] - 2022-05-11

### Added
- FAQ


## [0.18.4] - 2021-04-01

### Fixed
- Remove Gutenberg again


## [0.18.3] - 2021-04-01

### Added
- News can now have custom slugs


## [0.18.2] - 2021-03-23

### Fixed
- Change userscript script field type


## [0.18.1] - 2021-03-23

### Fixed
- Change userscript script field type


## [0.18.0] - 2021-03-23

### Added
- Userscripts are now a custom post type with auto-update functionality


## [0.17.1] - 2021-03-01

### Fixed
- Disabled paging on vscode_snippet query


## [0.17.0] - 2021-02-17

### Added
- Autoshy post type for consumption through REST API


## [0.16.0] - 2020-11-02

### Added
- Schema.org generator for dentist type

### Changed
- Cleanup code


## [0.15.4] - 2020-10-08

### Added
- Added benefits to jobpost generator


## [0.15.3] - 2020-10-08

### Fixed
- Fix jobpost generator layout


## [0.15.2] - 2020-09-25

### Fixed
- Generate news teaser image alt tag based on title

### Changed
- Add explanation label to news teaser image input


## [0.15.1] - 2020-09-24

### Changed
- Include date in newsgenerator title output


## [0.15.0] - 2020-09-24

### Added
- Teaserimage support for newsgenerator

### Changed
- Structured newsgenerator output
- Updated node modules


## [0.14.0] - 2020-08-18

### Added
- FAQ-Generator
- tinyMCE buttons to create tags


## [0.13.0] - 2020-06-22

### Added
- Added notifications


## [0.12.2] - 2020-05-11

### Fixed
- Darkmode for quicksearch
- Focus styling for quicksearch
- Tweak darkmode background for .box


## [0.12.1] - 2020-04-15

### Added
- Show parent page name in quicksearch


## [0.12.0] - 2020-04-15

### Added
- Quicksearch in header


## [0.11.10] - 2020-03-16

### Fixed
- Escape newlines in jobpost generator output


## [0.11.9] - 2020-03-03

### Changed
- Split date input in jobpost generator


## [0.11.8] - 2020-02-26

### Fixed
- Fixed newsgenerator now looking for a select with name="gewerk"


## [0.11.7] - 2020-02-26

### Fixed
- Fixed form select fractal stripping last option


## [0.11.6] - 2020-02-25

### Fixed
- Codeview JS output shouldn't be minified


## [0.11.5] - 2020-02-25

### Fixed
- Rework codeview JS injection


## [0.11.4] - 2020-02-25

### Fixed
- Escape backticks in codeview preview JS injection


## [0.11.3] - 2020-02-21

### Changed
- Restructure generator forms for better readability
- Update form fractals to display markers for required fields


## [0.11.2] - 2020-02-20

### Changed
- Changed the way full-width inputs are generated


## [0.11.1] - 2020-02-20

### Fixed
- Fix dark mode input placeholder color


## [0.11.0] - 2020-02-20

### Added
- job posting json generator

### Fixed
- Fix form fields not extending to full width of the column


## [0.10.0] - 2020-02-19

### Added
- Code button for TinyMCE


## [0.9.4] - 2019-12-05

### Fixed
- Scope Generator JS
- Fix Google Maps init


## [0.9.3] - 2019-12-05

### Fixed
- Fix Google maps loading order and default values


## [0.9.2] - 2019-12-05

### Changed
- Pull Google API key using InsertFirmendaten


## [0.9.1] - 2019-12-04

### Fixed
- Fixed news- and mapgenerators loading own script before jQuery was initialized


## [0.9.0] - 2019-12-04

### Added
- Bundle assets with webpack

### Changed
- Use Inter as default font https://rsms.me/inter/
- Replace Fontawesome with inline SVG


## [0.8.2] - 2019-11-29

### Fixed
- reference jQuery instead of $ in backend


## [0.8.1] - 2019-11-29

### Fixed
- Enqueue jQuery in Backend


## [0.8.0] - 2019-11-27

### Added
- simplebar for codebox
- display version number in footer

### Fixed
- Do not set a cookie when enabling dark mode based on `prefers-color-scheme`
