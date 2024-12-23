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
    # The way files are persisted. Can be "database" or "blob". Defaults to "database"
    file_storage:         database
    # Base URL for blob storage API
    blob_base_url:        ~
    # Bucket id for blob storage
    blob_bucket_id:       ~
    # Secret key for blob storage
    blob_key:             ~
    # Identity provider base URL for blob storage API
    blob_idp_url:         ~
    # Identity provider client id for blob storage
    blob_oauth_client_id: ~
    # Identity provider client secret for corresponding client id
    blob_oauth_client_secret: ~
    group:
        iri_template:         /base/organizations/%s
        address_attributes:
            street:               streetAddress
            locality:             addressLocality
            postal_code:          postalCode
            country:              addressCountry
    authorization:
        policies:             []
        roles:
            # Returns true if the user is allowed to use the dispatch API.
            ROLE_USER:            'false'
        resource_permissions:
            # Returns true if the user has read access for the given group, limited to metadata.
            ROLE_GROUP_READER_METADATA: 'false'
            # Returns true if the user has read access for the given group, including delivery content. Implies the metadata reader role.
            ROLE_GROUP_READER_CONTENT: 'false'
            # Returns true if the user has write access for the given group. Implies all reader roles.
            ROLE_GROUP_WRITER:    'false'
            # Returns true if the user has write access for the given group and can read recipient addresses. Implies all reader/writer roles.
            ROLE_GROUP_WRITER_READ_ADDRESS: 'false'
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
