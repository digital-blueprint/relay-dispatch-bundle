# DbpRelayDispatchBundle

[GitLab](https://gitlab.tugraz.at/dbp/dual-delivery/dbp-relay-dispatch-bundle) |
[Frontend Application](https://gitlab.tugraz.at/dbp/dual-delivery/dispatch)

There is a corresponding frontend application that uses this API at [Dual Delivery Frontend Application](https://gitlab.tugraz.at/dbp/dual-delivery/dispatch).

### Database migration

Run this script to migrate the database. Run this script after installation of the bundle and
after every update to adapt the database to the new source code.

```bash
php bin/console doctrine:migrations:migrate --em=dbp_relay_dispatch_bundle
```

### Settings

```bash
# base64 encode p12 cert
base64 -w 0 < cert.p12 > cert.p12.base64

# set secret for the .env file
php bin/console secrets:set DISPATCH_CERT_P12 cert.p12.base64
```

TODO