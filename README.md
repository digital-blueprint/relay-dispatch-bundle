# DbpRelayDispatchBundle

[GitLab](https://gitlab.tugraz.at/dbp/dual-delivery/dbp-relay-dispatch-bundle) |
[Frontend Application](https://gitlab.tugraz.at/dbp/dual-delivery/dispatch)

There is a corresponding frontend application that uses this API at
[Dual Delivery Frontend Application](https://gitlab.tugraz.at/dbp/dual-delivery/dispatch).

## Database migration

Run this script to migrate the database. Run this script after installation of the bundle and
after every update to adapt the database to the new source code.

```bash
php bin/console doctrine:migrations:migrate --em=dbp_relay_dispatch_bundle
```

## Settings

```bash
# Convert p12 file to pem (pass -legacy if needed with openssl v3)
openssl pkcs12 -in cert.p12 -out cert.pem -clcerts

# base64 encode PEM
base64 -w 0 < cert.pem > cert.pem.base64

# set secret for the .env file
php bin/console secrets:set DISPATCH_CERT cert.pem.base64

# in the config file base64 decode again:
# cert: '%env(base64:DISPATCH_CERT)%'
```

## Commands

```bash
# Create request for user id 1234567890
./bin/console dbp:relay-dispatch:test-seed create 1234567890

# Create request for user id 1234567890 and directly submit it
./bin/console dbp:relay-dispatch:test-seed create 1234567890 --submit

# Show last 10 recipients
./bin/console dbp:relay-dispatch:recipient-list --limit 10

# Show last 5 submitted recipients after sending status requests
./bin/console dbp:relay-dispatch:recipient-list --limit 5 --submitted-only --status-requests

# Do status request for an AppDeliveryID
./console dbp:relay-dispatch:status-request ADID_relay-dispatch-bundle-f839234020-c4d545db-95d1-4358-b37b-fcca31680c9e
```
