# Changelog

# 0.3.7

- request: allow empty request name and referenceNumber and improve error handling

# 0.3.6

- request: enforce non-empty name and reference number and add error handling

# 0.3.5

- replaced deprecate ApiPlatform classes that will be removed in ApiPlatform version 3

# 0.3.4

- Fix PUT request for the /dispatch/requests/{identifier} endpoint

# 0.3.3

- Fix default value for the GROUPS config option
- Various internal cleanups with the goal to make it possible to support multiple service providers in the future
- Add a basic health check for the bundle authorization configuration. This checks for problems
like syntax errors and usage of invalid variables, methods and more.
- Work around 400 errors on "/dispatch/requests/{identifier}/submit" requests caused by the upgrade to api-platform 2.7

# 0.3.2

- minor cleanups

# 0.3.1

- request: load last status changes for each recipient of all requests

# 0.3.0
