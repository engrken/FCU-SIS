# FCU-SIS development instructions

FCU-SIS is a legacy unofficial PHP student information system.

Treat student records as private. Use an isolated local MySQL/MariaDB instance and synthetic records. Never reuse demonstration credentials for a public service. Preserve existing PHP behavior and inspect compatibility before upgrading syntax or dependencies. The development container is not a production hardening or database migration.

## Working practice

- Read existing code and applicable AGENTS.md files before editing. Keep changes focused and preserve unrelated work.
- Use the repository's existing dependencies and package manager. Do not invent test commands.
- Never print or commit credentials, environment files, personal student/customer data or production database exports.
- Prefer focused local checks. Batch changes to conserve CI and deployment quotas. Do not start cloud builds, deployments or migrations solely to validate documentation or development configuration.
- State what was actually verified and what remains untested. Successful compilation is not proof of live service or hardware correctness.
- GitHub Education entitlements belong to the eligible account/organization; repository configuration does not redeem benefits or supply public SaaS inference credits.

## Setup and validation

The container provides PHP 8.2 with mysqli and pdo_mysql for development. Legacy application compatibility is not yet verified. A separate disposable database and local-only connection configuration are required; do not import database.sql blindly or use production credentials.

See GITHUB_EDUCATION.md for cloud development and activation steps.
