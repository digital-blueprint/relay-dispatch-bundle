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
