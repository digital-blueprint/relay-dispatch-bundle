# CLI Commands

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
