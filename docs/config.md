# Configuration

## Bundle Configuration

Created via `./bin/console config:dump-reference DbpRelayDispatchBundle | sed '/^$/d'`

```yaml
# Default configuration for "DbpRelayDispatchBundle"
dbp_relay_dispatch:
    # The database DSN
    database_url:         ~ # Required
    # The base URL for the SOAP service of the dual delivery service provider
    service_url:          ~ # Required
    # The sender profile identifier, as specified/required by your service provider
    sender_profile:       ~ # Required
    # The sender profile version, as specified/required by your service provider
    sender_profile_version: ~ # Required
    # The client certificate in PEM format
    cert:                 ~
    # The password of the client certificate
    cert_password:        ~
    group:
        iri_template:         /base/organizations/%s
        address_attributes:
            street:               streetAddress
            locality:             addressLocality
            postal_code:          postalCode
            country:              addressCountry
    authorization:
        rights:
            # Returns true if the user is allowed to use the dispatch API.
            USER:                 'false'
            # Returns true if the user has read access for the given group, limited to metadata.
            GROUP_READER_METADATA: 'false'
            # Returns true if the user has read access for the given group, including delivery content. Implies the metadata reader role.
            GROUP_READER_CONTENT: 'false'
            # Returns true if the user has write access for the given group. Implies all reader roles.
            GROUP_WRITER:         'false'
        attributes:
            # Returns an array of available group IDs.
            GROUPS:               '[]'

```

## Client Certificate Tips

In case the "Dual Delivery" service provider requires a client certificate the `cert` and `cert_password` can be set. `cert` is the certificate in the `PEM` format.

In case the certificate is provided to you in the `pkcs12` format, usually a file ending with the `.p12` extension you can convert it to `PEM` using openssl:

```bash
# Convert p12 file to pem (in case the algorithm is outdated you might have to pass "-legacy")
openssl pkcs12 -in cert.p12 -out cert.pem -clcerts
```

To put this `PEM` value into the Symfony dotenv config or the Symfony secrets store it's easiest to convert it to base64 and decode it again in the dispatch bundle config:

```bash
# base64 encode PEM
base64 -w 0 < cert.pem > cert.pem.base64

# set secret for the .env file
php bin/console secrets:set DISPATCH_CERT cert.pem.base64

# in the config file base64 decode again:
# dbp_relay_dispatch:
#   cert: '%env(base64:DISPATCH_CERT)%'
```
