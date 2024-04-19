# Changelog

## 0.5.6

* The `SendingServiceMessageID` will now be fetched for StatusChange messages and put into the description field
* Add POST and DELETE endpoints `/dispatch/request-status-changes/{identifier}/file` for DeliveryStatusChange file upload.

## 0.5.5

* Psalm errors were suppress

## 0.5.4

* Add support for api-platform 3.2

## 0.5.3

* Work around person provider no longer supporting IRI lookup

## 0.5.2
* Add Blob OAuth support for additional authentication

## 0.5.1

* Fix the accepted content type for the new PATCH method for compatibility with the upcoming ApiPlatform upgrade

## 0.5.0

* Replace PUT with PATCH for upcoming ApiPlatform upgrade and standard compliant Http PUT

## 0.4.20

- Add support for Symfony 6

## 0.4.19

- Drop support for PHP 7.4/8.0

## 0.4.18

- Use application/ld+json for the API docs examples

## 0.4.17

- Migrate to new BlobApiError class

## 0.4.16

- Cleanup

## 0.4.15

- Port to the new api-platform metadata system. No user visible changes.
- Fix some example bodies in the api docs.

## 0.4.14

- JSON-LD contexts are no longer embedded in the API responses, they have to be fetched separately.
- Drop support for PHP 7.3

## 0.4.13

- fix: content URL loading for status changes when file is stored in database

## 0.4.12

- add: blob integration for delivery status change files

## 0.4.11

- update: `dbp/relay-blob-library` to version 0.1.7 to handle the breaking changes in blob bundle version 0.1.14

## 0.4.10

- refactor: method names for `dbp/relay-blob-library` version 0.1.2

## 0.4.9

- composer: fix content hash

## 0.4.8

- use: `\Dbp\Relay\BlobLibrary\Api\BlobApi` from `dbp/relay-blob-library`

## 0.4.7

- fix: ignore 404 error when removing blob files by prefix
- use: `dbp/relay-blob-library`

## 0.4.6

- fix: blob content url loading

## 0.4.5

- add: blob storage data loading and persisting handling and enable blob storage

## 0.4.4

- add: more blob storage implementation and documentation

## 0.4.3

- Adjust for core-bundle API changes
- Fix URL signatures for blob storage for files containing spaces in some cases

## 0.4.2

- don't set a request to "submitted" if submission requirements fail
- minor cleanup

## 0.4.1

- add: `blob_base_url` setting and start of blob file storage implementation

## 0.4.0

- add: blob and file-storage settings

## 0.3.7

- request: allow empty request name and referenceNumber and improve error handling

## 0.3.6

- request: enforce non-empty name and reference number and add error handling

## 0.3.5

- replaced deprecate ApiPlatform classes that will be removed in ApiPlatform version 3

## 0.3.4

- Fix PUT request for the `/dispatch/requests/{identifier}` endpoint

## 0.3.3

- Fix default value for the GROUPS config option
- Various internal cleanups with the goal to make it possible to support multiple service providers in the future
- Add a basic health check for the bundle authorization configuration. This checks for problems
like syntax errors and usage of invalid variables, methods and more.
- Work around 400 errors on `/dispatch/requests/{identifier}/submit` requests caused by the upgrade to api-platform 2.7

## 0.3.2

- minor cleanups

## 0.3.1

- request: load last status changes for each recipient of all requests

## 0.3.0
