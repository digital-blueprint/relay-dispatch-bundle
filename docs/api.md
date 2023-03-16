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
