# Changelog

All notable changes to Velt Skeleton are documented in this file.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and releases use [Semantic Versioning](https://semver.org/).

## [0.1.7] - 2026-07-24

### Fixed

- Make the development server listen on all network interfaces by default so
  physical devices can reach mobile preview endpoints.
- Display separate local and mobile URLs when starting the server.
- Warn when the server is explicitly bound to a loopback-only address.

### Changed

- Clarify the default mobile preview workflow in the documentation.

## [0.1.6] - 2026-07-20

### Added

- Complete QR-based mobile preview flow.
- Network address detection for preview URLs.
- JSON preview rendering for skeleton views.

## [0.1.5] - 2026-07-18

### Added

- Mobile preview QR command and persisted preview sessions.

[0.1.7]: https://github.com/Velt-PHP/veltphp-skeleton/compare/v0.1.6...v0.1.7
[0.1.6]: https://github.com/Velt-PHP/veltphp-skeleton/compare/v0.1.5...v0.1.6
[0.1.5]: https://github.com/Velt-PHP/veltphp-skeleton/releases/tag/v0.1.5
