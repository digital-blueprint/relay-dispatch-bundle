# CLI Commands

```bash
# Create request for user id 1234567890
./bin/console dbp:relay-dispatch:test-seed create --request-person-id=4455667788 --recipient-person-id=1234567890

# Create request for user id 1234567890 and submit it to the queue
./bin/console dbp:relay-dispatch:test-seed create --request-person-id=4455667788 --recipient-person-id=1234567890 --submit

# Create request for user id 1234567890 and directly submit it without queue
./bin/console dbp:relay-dispatch:test-seed create --request-person-id=4455667788 --recipient-person-id=1234567890 --submit --direct

# Create request for user id 1234567890, directly submit it without queue and show the xml of the request
./bin/console dbp:relay-dispatch:test-seed create --request-person-id=4455667788 --recipient-person-id=1234567890 --submit --direct --output-request-xml

# Create and submit request for Heinrich Mustermann for the address "Am Umweg 9" and show the xml of the request
./bin/console dbp:relay-dispatch:test-seed create \
    --request-person-id=4455667788 \
    --recipient-given-name=Heinrich \
    --recipient-family-name=Mustermann \
    --recipient-street-address="Am Umweg 9" \
    --recipient-postal-code=8010 \
    --recipient-address-locality=Graz \
    --recipient-address-country=AT \
    --submit --direct --output-request-xml

# Show last 10 recipients
./bin/console dbp:relay-dispatch:recipient-list --limit 10

# Show last 5 submitted recipients after sending status requests
./bin/console dbp:relay-dispatch:recipient-list --limit 5 --submitted-only --status-requests

# Do status request for an AppDeliveryID
./bin/console dbp:relay-dispatch:status-request ADID_relay-dispatch-bundle-f839234020-c4d545db-95d1-4358-b37b-fcca31680c9e

# Do status request for an AppDeliveryID and output the response xml
./bin/console dbp:relay-dispatch:status-request ADID_relay-dispatch-bundle-f839234020-c4d545db-95d1-4358-b37b-fcca31680c9e --output-response-xml

# Create a DeliveryStatusChange for a request recipient with a file
./bin/console dbp:relay-dispatch:delivery-status-change create 3e2cb1fd-b536-42aa-95d6-49cfeb53cb92  --status-type=26 --description="Just a test" --with-file
```
