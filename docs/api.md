# API

## DeliveryStatusChange

### dispatchStatus

Can have one of the following values: `failure`, `success`, `pending`, `unknown`

| dispatchStatus | Description                                        |
|----------------|----------------------------------------------------|
| `failure`      | Means that the delivery failed                     |
| `success`      | Means that the delivery was successful             |
| `pending`      | Means that the delivery is pending / or in-transit |
| `unknown`      | Means that the delivery status is unknown          |

## Error Codes

| relay:errorId                                                      | Status code | Description                                                                        |
|--------------------------------------------------------------------|-------------|------------------------------------------------------------------------------------|
| `dispatch:request-file-missing-request-identifier`                 | `400`       | `Missing "dispatchRequestIdentifier"!`                                             |
| `dispatch:request-submitted-read-only`                             | `400`       | `Submitted requests cannot be modified!`                                           |
| `dispatch:request-file-missing-file`                               | `400`       | `No file with parameter key "file" was received!`                                  |
| `dispatch:request-file-upload-error`                               | `400`       |                                                                                    |
| `dispatch:request-file-only-pdf-files-allowed`                     | `415`       | `Only PDF files can be added!`                                                     |
| `dispatch:request-file-empty-files-not-allowed`                    | `400`       | `Empty files cannot be added!`                                                     |
| `dispatch:request-recipient-person-identifier-and-person-data-set` | `400`       | `A request recipient can't contain a personIdentifier and personal data together!` |
| `dispatch:current-person-not-found`                                | `403`       | `Current person wasnt found!`                                                      |
| `dispatch:request-not-found`                                       | `404`       | `Request was not found!`                                                           |
| `dispatch:request-status-change-not-found`                         | `404`       | `DeliveryStatusChange was not found!`                                              |
| `dispatch:delivery-status-change-blob-identifier-invalid`          | `500`       | `DeliveryStatusChange has invalid blob identifier!`                                |
| `dispatch:delivery-status-change-blob-download-error`              | `500`       | `File of the DeliveryStatusChange could not be downloaded from Blob!`              |
| `dispatch:delivery-status-change-wrong-status-error`               | `500`       | `Receipt can not be uploaded in this status!`                                      |
| `dispatch:request-recipient-not-found`                             | `404`       | `RequestRecipient was not found!`                                                  |
| `dispatch:request-file-not-found`                                  | `404`       | `RequestFile was not found!`                                                       |
| `dispatch:request-files-not-found`                                 | `404`       | `RequestFiles were not found!`                                                     |
| `dispatch:request-not-created`                                     | `500`       | `Request could not be updated!`                                                    |
| `dispatch:request-recipient-not-created`                           | `500`       | `RequestRecipient could not be created!`                                           |
| `dispatch:request-file-not-created`                                | `500`       | `RequestFile could not be created!`                                                |
| `dispatch:request-file-blob-upload-error`                          | `500`       | `RequestFile could not be uploaded to the Blob service!`                           |
| `dispatch:request-file-blob-download-error`                        | `500`       | `RequestFile could not be downloaded from the Blob service!`                       |
| `dispatch:request-file-blob-delete-error`                          | `500`       | `RequestFile could not be deleted from the Blob service!`                          |
| `dispatch:delivery-status-change-file-blob-delete-error`           | `500`       | `DeliveryStatusChange file could not be deleted from the Blob service!`            |
| `dispatch:request-status-not-created`                              | `500`       | `DeliveryStatusChange could not be created!`                                       |
| `dispatch:request-status-file-not-created`                         | `500`       | `DeliveryStatusChange file could not be created!`                                  |
| `dispatch:request-status-file-not-deleted`                         | `500`       | `DeliveryStatusChange file could not be deleted!`                                  |
| `dispatch:request-already-submitted`                               | `400`       | `Request was already submitted!`                                                   |
| `dispatch:request-has-no-recipients`                               | `400`       | `Request has no recipients!`                                                       |
| `dispatch:request-has-no-files`                                    | `400`       | `Request has no files!`                                                            |
| `dispatch:request-has-recipient-without-delivery-method`           | `400`       | `Request has a recipient without a delivery method!`                               |
| `dispatch:request-pre-addressing-failed`                           | `500`       | `PreAddressing request failed!`                                                    |
| `dispatch:request-pre-addressing-not-found`                        | `404`       | `Person was not found!`                                                            |
| `dispatch:write-cert-error`                                        | `500`       | `Cert data could not be written to file!`                                          |
| `dispatch:status-request-soap-error`                               | `500`       | `DualDelivery status request failed!`                                              |
| `dispatch:dispatch:status-request-failed`                          | `500`       | `StatusRequest request failed!`                                                    |
| `dispatch:dual-delivery-request-soap-error`                        | `500`       | `DualDelivery request failed!`                                                     |
| `dispatch:dual-delivery-request-failed`                            | `500`       | `DualDelivery request failed!`                                                     |
| `dispatch:request-recipient-not-updated`                           | `500`       | `DualDelivery request failed!`                                                     |
| `dispatch:request-recipient-delivery-end-date-not-set`             | `500`       | `DeliveryEndDate of RequestRecipient could not be set!`                            |
| `dispatch:request-recipient-missing-request-identifier`            | `400`       | `Missing "dispatchRequestIdentifier"!`                                             |
| `dispatch:request-invalid-reference-number`                        | `400`       | `referenceNumber wasn't set correctly!`                                            |
| `dispatch:request-name-empty`                                      | `400`       | `name must not be empty!`                                                          |
