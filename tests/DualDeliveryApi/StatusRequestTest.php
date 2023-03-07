<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\StatusRequestType;
use Dbp\Relay\DispatchBundle\Service\DualDeliveryService;
use PHPUnit\Framework\TestCase;

class StatusRequestTest extends TestCase
{
    use BaseSoapTrait;

    private static $SUCCESS_RESPONSE = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns2:StatusResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ns3="uri:general.additional.params/20130121#" xmlns:ns4="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns5="http://reference.postserver.at/namespace/persondata/20170308#" xmlns:ns6="http://www.w3.org/2000/09/xmldsig#" xmlns:ns7="http://www.ebinterface.at/schema/4p0/" xmlns:ns8="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns9="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns10="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns11="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns12="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns13="http://www.e-zustellung.at/namespaces/zuse_20090922" xmlns:ns14="http://reference.e-government.gv.at/namespace/zustellung/dual_ca/20130121#" xmlns:ns15="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" version="1.0">
      <AppDeliveryID>foo-6374de7d5ed47</AppDeliveryID>
      <DualDeliveryID>132478</DualDeliveryID>
      <Status>
        <Code>P3</Code>
        <Text>InDelivery</Text>
      </Status>
    </ns2:StatusResponse>
  </soap:Body>
</soap:Envelope>';

    private static $DELIVERY_NOTIFICATION_RESPONSE_E_DELIVERY = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns2:StatusResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ns3="uri:general.additional.params/20130121#" xmlns:ns4="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns5="http://reference.postserver.at/namespace/persondata/20170308#" xmlns:ns6="http://www.w3.org/2000/09/xmldsig#" xmlns:ns7="http://www.ebinterface.at/schema/4p0/" xmlns:ns8="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns9="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns10="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns11="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns12="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns13="http://www.e-zustellung.at/namespaces/zuse_20090922" xmlns:ns14="http://reference.e-government.gv.at/namespace/zustellung/dual_ca/20130121#" xmlns:ns15="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" version="1.0">
      <AppDeliveryID>887b3816-2212-434f</AppDeliveryID>
      <DualDeliveryID>2398411</DualDeliveryID>
      <ns2:Result>
        <ns2:NotificationChannel>
          <ns2:EDeliveryNotification xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="ns2:EDeliveryNotificationType">
            <ns2:BinaryDeliveryNotification>PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxEZWxpdmVyeU5vdGlmaWNhdGlvbiB4bWxucz0iaHR0cDovL3JlZmVyZW5jZS5lLWdvdmVybm1lbnQuZ3YuYXQvbmFtZXNwYWNlL3p1c3RlbGx1bmcvbXNnL3BoYXNlMi8yMDE4MTIwNiMiIHhtbG5zOm5zMj0iaHR0cDovL3JlZmVyZW5jZS5lLWdvdmVybm1lbnQuZ3YuYXQvbmFtZXNwYWNlL3BlcnNvbmRhdGEvcGhhc2UyLzIwMTgxMjA2IyIgeG1sbnM6bnMzPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwLzA5L3htbGRzaWcjIj48RGVsaXZlcnlTeXN0ZW0+aHR0cHM6Ly93d3cubWVpbnBvc3RmYWNoLmF0L3p1c2Uvc2VydmljZXMvYXBwMnp1c2U8L0RlbGl2ZXJ5U3lzdGVtPjxaU0RlbGl2ZXJ5SUQ+ZTE0ZDZjYzItNzYxNy0xMTJkLThmZjYtNTlhOGIyNmUwZDUxPC9aU0RlbGl2ZXJ5SUQ+PEFwcERlbGl2ZXJ5SUQ+MTczMDMxNTwvQXBwRGVsaXZlcnlJRD48R1o+ODg3YjQ4MTYtMjIzMy00ZDRmLWI4MTEtMmJlMDlhNGZhMzU4LTM4MTU4ODk1LTkxMmItNDYxYy04YTZmLTQ1ZTg1YjMwZWY4YzwvR1o+PFNlbmRlckRldGFpbHM+PG5zMjpJZGVudGlmaWNhdGlvbj48bnMyOlZhbHVlPjkxMTAwMDgwODQ2NDE8L25zMjpWYWx1ZT48bnMyOlR5cGU+dXJuOnB1YmxpY2lkOmd2LmF0OmJhc2VpZCtYRVJTQjwvbnMyOlR5cGU+PC9uczI6SWRlbnRpZmljYXRpb24+PG5zMjpDb3Jwb3JhdGVCb2R5PjxuczI6RnVsbE5hbWU+VGVjaG5pc2NoZSBVbml2ZXJzaXTDpHQgR3JhejwvbnMyOkZ1bGxOYW1lPjwvbnMyOkNvcnBvcmF0ZUJvZHk+PC9TZW5kZXJEZXRhaWxzPjxSZWNlaXZlckRldGFpbHM+PG5zMjpJZGVudGlmaWNhdGlvbj48bnMyOlZhbHVlPnArTU5TbXE3L0VZUnI4T0NYUkNPYVVlU2Y0NlQ0Q0lUU2FMOFY3REkxNFdEU29xRlhsVS8vSFFXUFJyY01IN2RHc2VlbDdsS1ZZcHMraE02bE5OeWFNWENvUFBPeW9LV05mWjd3QzVFWXpHUGFVb25yVjNjZ1plSlE1K3Q5blBBTzVzNXFWZmZ2VFBTemVKUkkxSUVTaWdSU1d6ZzQvNFhhRzRIam9FVFc4bz08L25zMjpWYWx1ZT48bnMyOlR5cGU+dXJuOnB1YmxpY2lkOmd2LmF0OmVjZGlkK1pVU0VBTU9EK1pVPC9uczI6VHlwZT48L25zMjpJZGVudGlmaWNhdGlvbj48bnMyOlBoeXNpY2FsUGVyc29uPjxuczI6TmFtZT48bnMyOkdpdmVuTmFtZT5QYXRyaXppbzwvbnMyOkdpdmVuTmFtZT48bnMyOkZhbWlseU5hbWU+QmVrZXJsZTwvbnMyOkZhbWlseU5hbWU+PC9uczI6TmFtZT48bnMyOkRhdGVPZkJpcnRoPjE5NzgtMDgtMDM8L25zMjpEYXRlT2ZCaXJ0aD48L25zMjpQaHlzaWNhbFBlcnNvbj48L1JlY2VpdmVyRGV0YWlscz48VGltZXN0YW1wPjIwMjItMTItMDdUMTE6MTU6MDIuNDQ0KzAxOjAwPC9UaW1lc3RhbXA+PFVzZXI+PFJvbGU+UmVjZWl2ZXI8L1JvbGU+PG5zMjpJZGVudGlmaWNhdGlvbj48bnMyOlZhbHVlPnArTU5TbXE3L0VZUnI4T0NYUkNPYVVlZGdYWlQ0Q0lUU2FMOFY3REkxNFdEU29xRlhsVS8vSFFXUFJyY01IN2RHc2VlbDdsS1ZZcHMraE02bE5OeWFNWENvUFBPeW9LV05mWjd3QzVFWXpHUGRzQXNqazYybVplSlE1K3Q5blBBTzVzNXFWZmZ2VFBTemVKUkkxSUVTaWdSU1d6ZzQvNFhhRzRIam9FVFc4bz08L25zMjpWYWx1ZT48bnMyOlR5cGU+dXJuOnB1YmxpY2lkOmd2LmF0OmVjZGlkK1pVU0VBTU9EK1pVPC9uczI6VHlwZT48L25zMjpJZGVudGlmaWNhdGlvbj48bnMyOlBoeXNpY2FsUGVyc29uPjxuczI6TmFtZT48bnMyOkdpdmVuTmFtZT5GaXJzdG5hbWU8L25zMjpHaXZlbk5hbWU+PG5zMjpGYW1pbHlOYW1lPkxhc3RuYW1lPC9uczI6RmFtaWx5TmFtZT48L25zMjpOYW1lPjxuczI6RGF0ZU9mQmlydGg+MTk3Ny0wNy0wNzwvbnMyOkRhdGVPZkJpcnRoPjwvbnMyOlBoeXNpY2FsUGVyc29uPjwvVXNlcj48QWNjZXB0ZWQ+PE5vdGlmaWNhdGlvbnNQZXJmb3JtZWQ+PFJlY2lwaWVudE5vdGlmaWNhdGlvbj48VGltZXN0YW1wPjIwMjItMTItMDdUMTE6MTQ6NTEuMTQ0KzAxOjAwPC9UaW1lc3RhbXA+PC9SZWNpcGllbnROb3RpZmljYXRpb24+PC9Ob3RpZmljYXRpb25zUGVyZm9ybWVkPjxOb3RpZmljYXRpb25BZGRyZXNzTGlzdD48SW50ZXJuZXRBZGRyZXNzPjxuczI6QWRkcmVzcz51c2VyQG5hbWUuY29tPC9uczI6QWRkcmVzcz48L0ludGVybmV0QWRkcmVzcz48L05vdGlmaWNhdGlvbkFkZHJlc3NMaXN0PjwvQWNjZXB0ZWQ+PGRzaWc6U2lnbmF0dXJlIElkPSJzaWduYXR1cmUtMS0xIiB4bWxuczpkc2lnPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwLzA5L3htbGRzaWcjIj48ZHNpZzpTaWduZWRJbmZvPjxkc2lnOkNhbm9uaWNhbGl6YXRpb25NZXRob2QgQWxnb3JpdGhtPSJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy14bWwtYzE0bi0yMDAxMDMxNSIvPjxkc2lnOlNpZ25hdHVyZU1ldGhvZCBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnLzIwMDEvMDQveG1sZHNpZy1tb3JlI3JzYS1zaGE1MTIiLz48ZHNpZzpSZWZlcmVuY2UgSWQ9InJlZmVyZW5jZS0xLTEiIFVSST0iIj48ZHNpZzpUcmFuc2Zvcm1zPjxkc2lnOlRyYW5zZm9ybSBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvMDkveG1sZHNpZyNlbnZlbG9wZWQtc2lnbmF0dXJlIi8+PC9kc2lnOlRyYW5zZm9ybXM+PGRzaWc6RGlnZXN0TWV0aG9kIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvMjAwMS8wNC94bWxlbmMjc2hhNTEyIi8+PGRzaWc6RGlnZXN0VmFsdWU+L3pZeXRmRDN5eHk0R2pPMURqVWFnM0dvdk04ZFpBU2YzMU1CVU90SnZwclcyZlhNZFNEMlVEazFZaFVzdUJMUApPV0NsZ3Q3ZVdEQmM4RWNXUjdWUEJnPT08L2RzaWc6RGlnZXN0VmFsdWU+PC9kc2lnOlJlZmVyZW5jZT48ZHNpZzpSZWZlcmVuY2UgVHlwZT0iaHR0cDovL3VyaS5ldHNpLm9yZy8wMTkwMyNTaWduZWRQcm9wZXJ0aWVzIiBVUkk9IiNldHNpLXNpZ25lZC0xLTEiPjxkc2lnOkRpZ2VzdE1ldGhvZCBBbGdvcml0aG09Imh0dHA6Ly93d3cudzMub3JnLzIwMDEvMDQveG1sZW5jI3NoYTUxMiIvPjxkc2lnOkRpZ2VzdFZhbHVlPkczWDRzM3RTRmFlQXlhS2NYM2FjcVBUMGQ0NlNqd0FwYzFRKythUUNjdXE2MVh2dElDOHQyZ2pZczJIOGpqCk1vcXNDNCtVamZ4M0ZOLzF6TStEeUE9PTwvZHNpZzpEaWdlc3RWYWx1ZT48L2RzaWc6UmVmZXJlbmNlPjwvZHNpZzpTaWduZWRJbmZvPjxkc2lnOlNpZ25hdHVyZVZhbHVlPlJuM21qY3BXWjRhdGVrSG1VT1V0RThURk5SMVpSMnQzcDRjRjlJdVVlbWtHMHJYU052RWNuWHc5a1g4MTdlRGsKSjExbVIwUGR0aU1IUFZ2eGJyRlpidWlhUE04ek91VVB4K05YTDFLWml2WmVCR3Z0R2dqaFRzRHZGMjBjTGxqYgpGZk5ZRTJTeUJ4cFY2dnRCTEZXU2xMcFduWWhFR3JIb1UvbjF0c2ZhNlcrS0svb3B1S21qczFrV3dBdApObmkwcDhJZ2JENUV3cUl2MlZKUDFGT1JPU0h1NTErN1JRQ1NlRnRrS0dYNFM1Z3R4R3N5bFFiMXkyMDdCL2loClpjYkZHWHo0ejhEMng5VVMzdVJnTzNsNGpwaTB5Wm01MEVHcHE3N1R2ZmFjeG11TFZZb2ljZ2IycXVlc2h5emgKaUViTmx2OWtvZys3a3BBdWdQQWgxdz09PC9kc2lnOlNpZ25hdHVyZVZhbHVlPjxkc2lnOktleUluZm8+PGRzaWc6WDUwOURhdGE+PGRzaWc6WDUwOUNlcnRpZmljYXRlPk1JSUZOakNDQkI2Z0F3SUJBZ0lFZFM0S2VEQU5CZ2txaGtpRzl3MEJBUVVGQURDQm56RUxNQWtHQTFVRUJoTUMKUVZReFNEQkdCZ05WQkFvTVAwRXRWSEoxYzNRZ1IyVnpMaUJtTGlCVGFXTm9aWEpvWldsMGMzTjVjM1JsYldVZwphVzBnWld4bGEzUnlMaUJFWVhSbGJuWmxjbXRsYUhJZ1IyMWlTREVpTUNBR0ExVUVDd3daWVMxemFXZHVMV052CmNuQnZjbUYwWlMxc2FXZG9kQzB3TXpFaU1Lc2lmMjFFQXd3WllTMXphV2R1TFdOdmNuQnZjbUYwWlMxc2FXZG8KZEMwd016QWVGdzB4T1RBMk1UZ3dPVEkyTURaYUZ3MHlOREEyTVRnd056STJNRFphTUlHZk1Rc3dDUVlEVlFRRwpFd0pCVkRFeE1DOEdBMVVFQ2d3b2EySndjbWx1ZEdOdmJTNWhkQ0JFY25WamF5QXJJRXR2YlcxMWJtbHJZWFJwCmIyNGdSMjFpU0RFTE1Ba0dBMVVFQ3d3Q1NWUXhGakFVQmdOVkJBTU1EV3RpY0hKcGJuUmpiMjB1WVhReEZUQVQKQmdOVkJBVVRERFl5TnpjeU56RWZKYU13T3pFaE1COEdDU3FHU0liM0RRRUpBUXdTYVc1MFpYSnVaWFJBWkhCcApMbU52TG1GME1JSUJJakFOQmdrcWhraUc5dzBCQVFFRkFBT0NBUThBTUlJQkNnS0NBUUVBblZPYmZQcHp3TGcwCmJ1ZTZsZDNyWmFSM3p0RUIrSVpZcW8wdFFtelZIRmh1RXFobDVhbDBZd2poUEl5NWNuOFJWdTAwYnRBc3FsNkcKRTAzdDZHajVJVzMwTkFYTlBROVg2VXdSN21JYjFPb3UxS3pMZ1VWNXRqTTVOYml0VEtKeDhyUjM0NVQzZUhDVgpvTUQzZkdTZTFhQjFOQjdsRHhmYTNaenhWRGtuOVZZK0sxcDBsaWpGaUo2WHJUWHFWdTU0OG51K0JNVnYraTVvCk8rRFFBcnMxQmEyZ2ZESDhrdEJSaGJsWDk1Z0pkbzRESUVkZy9wb2VvbklJMEsrWDk4d3AxYUlGL1lsbnBwS28KMS9tVVNuY2srMkMxMlMvZ1ZtNDZxMG5MaUVUOURPQkI0ZHNCcGxzNjVaaWVESStWUmxNSGN6T0tBN2pWRTRxeApwaUMyM091ZVp3SURBUUFCbzRJQmRqQ0NBWEl3ZmdZSUt3WUJCUVVIQVFFRWNqQndNRVVHQ0NzR0FRVUZCekFDCmhqbG9kSFJ3T2k4dmQzZDNMbUV0ZEhKMWMzUXVZWFF2WTJWeWRITXZZUzF6YVdkdUxXTnZjbkJ2Y21GMFpTMXMKYVdkb2RDMHdNeTVqY25Rd0p3WUlLd1lCQlFVSE1BR0dHMmgwZEhBNkx5OXZZM053TG1FdGRISjFjM1F1WVhRdgpiMk56Y0RBVEJnTlZIU01FRERBS2dBaEJrV2tjdjYzWW1EQkVCZ05WSFI4RVBUQTdNRG1nTjZBMWhqTm9kSFJ3Ck9pOHZZM0pzTG1FdGRISjFjM1F1WVhRdlkzSnNMMkV0YzJsbmJpMWpiM0p3YjNKaGRHVXRiR2xuYUhRdE1ETXcKRGdZRFZSMFBBUUgvQkFRREFnU3dNQkVHQTFVZERnUUtCQWhOK085aGpBWEE1VEFKQmdOVkhSTUVBakFBTUZnRwpBMVVkSUFSUk1FOHdUUVlIS2lnQUVRRUhBVEJDTUVBR0NDc0dBUVVGQndJQkZqUm9kSFJ3T2k4dmQzZDNMbUV0CmRISjFjM1F1WVhRdlpHOWpjeTlqY0M5aExYTnBaMjR0WTI5eWNHOXlZWFJsTFd4cFoyaDBNQTBHQnlvb0FBb0IKQVFJRUFnVUFNQTBHQ1NxR1NJYjNEUUVCQlFVQUE0SUJBUUNEZy9SMC9WRmFrb3l0RjNrQUgrL2Nad1NjWHQ5cQpQa2NXR21UTXFvRHRrUnRaS0kvQUpNTmZOSzZkb0pYcFUzZEk0S2cvUWt6WEJielBZTngzWnlxOEFWM3h0b2hVCkdKRGpDOGIrc3VnRCs1ZEluV3diVnM3dXlCRHNiSStrKzdjNlp0QTJmUTBscFF6TytpK0lUa3FXSHQ2SmU3LzYKbEZBcUJWV1hHWit3am50WDdLbnFlTVFsNlVTQmhXbWJZdlJ2SWM0bkRkcHhkMlQyc0tpTUtwc2E5TlF3aFk2RQppMGcrVUpkK3ltUXpmMlNsWXhobFpxWjk3UFBjWkQ2ZjhES1h5NWNTb1R5VmxMM1IwazlVamo2Nm9jak1lcG5PCnprVFJWMDViYmI2czlDbU1LNWRQUmprL21ydStyYXhCOVdQZDVGaXhmTEVLTXJXakdwUEdrM1ZOPC9kc2lnOlg1MDlDZXJ0aWZpY2F0ZT48L2RzaWc6WDUwOURhdGE+PC9kc2lnOktleUluZm8+PGRzaWc6T2JqZWN0PjxldHNpOlF1YWxpZnlpbmdQcm9wZXJ0aWVzIFRhcmdldD0iI3NpZ25hdHVyZS0xLTEiIHhtbG5zOmV0c2k9Imh0dHA6Ly91cmkuZXRzaS5vcmcvMDE5MDMvdjEuMy4yIyI+PGV0c2k6U2lnbmVkUHJvcGVydGllcyBJZD0iZXRzaS1zaWduZWQtMS0xIj48ZXRzaTpTaWduZWRTaWduYXR1cmVQcm9wZXJ0aWVzPjxldHNpOlNpZ25pbmdUaW1lPjIwMjItMTItMDdUMTA6MTU6MzhaPC9ldHNpOlNpZ25pbmdUaW1lPjxldHNpOlNpZ25pbmdDZXJ0aWZpY2F0ZT48ZXRzaTpDZXJ0PjxldHNpOkNlcnREaWdlc3Q+PGRzaWc6RGlnZXN0TWV0aG9kIEFsZ29yaXRobT0iaHR0cDovL3d3dy53My5vcmcvMjAwMS8wNC94bWxlbmMjc2hhNTEyIi8+PGRzaWc6RGlnZXN0VmFsdWU+bE1udGZTQjhiTTl0ekNucU5TYW1zMjNwbDFoWldkY3dKSllNSDRQNk9JQ1NHRFdxQ085RExNc0ZCbVdPQkl6Rgo1TGdYWDB4cDBnK2RmTE5IOVA0RjhnPT08L2RzaWc6RGlnZXN0VmFsdWU+PC9ldHNpOkNlcnREaWdlc3Q+PGV0c2k6SXNzdWVyU2VyaWFsPjxkc2lnOlg1MDlJc3N1ZXJOYW1lPkNOPWEtc2lnbi1jb3Jwb3JhdGUtbGlnaHQtMDMsT1U9YS1zaWduLWNvcnBvcmF0ZS1saWdodC0wMyxPPUEtVHJ1c3QgR2VzLiBmLiBTaWNoZXJoZWl0c3N5c3RlbWUgaW0gZWxla3RyLiBEYXRlbnZlcmtlaHIgR21iSCxDPUFUPC9kc2lnOlg1MDlJc3N1ZXJOYW1lPjxkc2lnOlg1MDlTZXJpYWxOdW1iZXI+MTk2NTk1MTYwODwvZHNpZzpYNTA5U2VyaWFsTnVtYmVyPjwvZXRzaTpJc3N1ZXJTZXJpYWw+PC9ldHNpOkNlcnQ+PC9ldHNpOlNpZ25pbmdDZXJ0aWZpY2F0ZT48ZXRzaTpTaWduYXR1cmVQb2xpY3lJZGVudGlmaWVyPjxldHNpOlNpZ25hdHVyZVBvbGljeUltcGxpZWQvPjwvZXRzaTpTaWduYXR1cmVQb2xpY3lJZGVudGlmaWVyPjwvZXRzaTpTaWduZWRTaWduYXR1cmVQcm9wZXJ0aWVzPjxldHNpOlNpZ25lZERhdGFPYmplY3RQcm9wZXJ0aWVzPjxldHNpOkRhdGFPYmplY3RGb3JtYXQgT2JqZWN0UmVmZXJlbmNlPSIjcmVmZXJlbmNlLTEtMSI+PGV0c2k6TWltZVR5cGU+dGV4dC94bWw8L2V0c2k6TWltZVR5cGU+PC9ldHNpOkRhdGFPYmplY3RGb3JtYXQ+PC9ldHNpOlNpZ25lZERhdGFPYmplY3RQcm9wZXJ0aWVzPjwvZXRzaTpTaWduZWRQcm9wZXJ0aWVzPjwvZXRzaTpRdWFsaWZ5aW5nUHJvcGVydGllcz48L2RzaWc6T2JqZWN0PjwvZHNpZzpTaWduYXR1cmU+PEFkZGl0aW9uYWxGb3JtYXQgVHlwZT0iYXBwbGljYXRpb24vcGRmIj5TVjlCVFY5QlgxQkVSZz09PC9BZGRpdGlvbmFsRm9ybWF0PjwvRGVsaXZlcnlOb3RpZmljYXRpb24+Cg==</ns2:BinaryDeliveryNotification>
          </ns2:EDeliveryNotification>
        </ns2:NotificationChannel>
      </ns2:Result>
      <Status>
        <Code>P6</Code>
        <Text>AllNotificationsReceived</Text>
      </Status>
    </ns2:StatusResponse>
  </soap:Body>
</soap:Envelope>';

    private static $DELIVERY_NOTIFICATION_RESPONSE_NOT_CLAIMED = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns2:StatusResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ns3="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns4="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns5="http://www.w3.org/2000/09/xmldsig#" xmlns:ns6="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns7="uri:general.additional.params/20130121#" xmlns:ns8="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns9="http://reference.bbgdual.dualdelivery.at/namespace/persondata/20170308#" xmlns:ns10="http://www.ebinterface.at/schema/4p0/" xmlns:ns11="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns12="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns13="http://www.e-zustellung.at/namespaces/zuse_20090922" xmlns:ns14="http://reference.e-government.gv.at/namespace/zustellung/dual_ca/20130121#" xmlns:ns15="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" version="1.0">
      <AppDeliveryID>ADID_relay-dispatch-bundle-1674638048-301afcb1-26dd-40b8-9a01-fb3b117f7b58</AppDeliveryID>
      <DualDeliveryID>2354469</DualDeliveryID>
      <ns2:Result>
        <ns2:NotificationChannel>
          <ns2:PostalNotification>
            <ns2:Printtime>2023-01-26T00:00:00Z</ns2:Printtime>
            <ns2:PostalDeliveryTime>2023-01-27T00:00:00Z</ns2:PostalDeliveryTime>
            <ns2:ServiceDeliveryTime>2023-01-25T10:16:38.000+01:00</ns2:ServiceDeliveryTime>
            <ns2:Sheets>2</ns2:Sheets>
            <ns2:AdditonalPrintResults>
              <ns2:PropertyValuePrintResultSet>
                <Parameter>
                  <Property>SendingServiceMessageID</Property>
                  <Value>BA00BUTU80230000000008</Value>
                </Parameter>
              </ns2:PropertyValuePrintResultSet>
            </ns2:AdditonalPrintResults>
            <ns2:ScannedData>
              <ns2:ExtractedMetaData namespace="http://www.plot.at/mprs/hybrRueckschein/v10/core">
                <SendungStatusResponse xmlns="http://www.plot.at/mprs/hybrRueckschein/v10/core" xmlns:brzdc="uri:unified.dual.callback" xmlns:brzdd="uri:unified.dual.delivery" xmlns:dd="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ddb="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" xmlns:ddca="http://reference.e-government.gv.at/namespace/zustellung/dual_ca/20130121#" xmlns:ddn="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ddp="http://reference.bbgdual.dualdelivery.at/namespace/persondata/20170308#" xmlns:ddpa="http://reference.e-government.gv.at/namespace/zustellung/dual_pa/20130121#" xmlns:egiz="uri:general.additional.params/20130121#" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:hrscore="http://www.plot.at/mprs/hybrRueckschein/v10/core" xmlns:mprscore="http://www.plot.at/mprs/bean/v10/core" xmlns:p="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:zuse="http://reference.e-government.gv.at/namespace/zustellung/msg/phase2/20181206#">
                  <SendungStatus>
                    <Barcode>BA00BUTU80230000000008</Barcode>
                    <StatusID>2459</StatusID>
                    <StatusText>nicht behoben</StatusText>
                    <Datum>2023-02-14</Datum>
                    <Abgabebereich>PP 8006</Abgabebereich>
                    <Attachment>
                      <AttachmentID>1</AttachmentID>
                      <FileName>HybridStatus_Request.xml</FileName>
                      <FileContent>
                        <Base64Content>PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzZW5kdW5nU3RhdHVzVHlwZT48QmFyY29kZT5CQTAwQlVUVTgwMjMwMDAwMDAwMDA4PC9CYXJjb2RlPjxTdGF0dXNJRD4yNDU5PC9TdGF0dXNJRD48U3RhdHVzVGV4dD5uaWNodCBiZWhvYmVuPC9TdGF0dXNUZXh0PjxEYXR1bT4yMDIzLTAyLTE0PC9EYXR1bT48VWhyemVpdD4wODoxNzowMDwvVWhyemVpdD48QWJnYWJlYmVyZWljaD5QUCA4MDA2PC9BYmdhYmViZXJlaWNoPjwvc2VuZHVuZ1N0YXR1c1R5cGU+</Base64Content>
                      </FileContent>
                    </Attachment>
                  </SendungStatus>
                </SendungStatusResponse>
              </ns2:ExtractedMetaData>
            </ns2:ScannedData>
          </ns2:PostalNotification>
        </ns2:NotificationChannel>
      </ns2:Result>
      <Status>
        <Code>P6</Code>
        <Text>AllNotificationsReceived</Text>
      </Status>
    </ns2:StatusResponse>
  </soap:Body>
</soap:Envelope>';

    private static $ERROR_TEXT_RESPONSE = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns2:StatusResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ns3="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns4="http://reference.bbgdual.dualdelivery.at/namespace/persondata/20170308#" xmlns:ns5="http://www.w3.org/2000/09/xmldsig#" xmlns:ns6="http://www.ebinterface.at/schema/4p0/" xmlns:ns7="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns8="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns9="uri:general.additional.params/20130121#" xmlns:ns10="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns11="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns12="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns13="http://www.e-zustellung.at/namespaces/zuse_20090922" xmlns:ns14="http://reference.e-government.gv.at/namespace/zustellung/dual_ca/20130121#" xmlns:ns15="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" version="1.0">
      <AppDeliveryID>4c87-bcf1-fb61e8b9a208</AppDeliveryID>
      <DualDeliveryID>2216679</DualDeliveryID>
      <ns2:Result>
        <Error>
          <Info>I am an error text.</Info>
          <Code>-1</Code>
        </Error>
      </ns2:Result>
      <Status>
        <Code>P9</Code>
        <Text>Error</Text>
      </Status>
    </ns2:StatusResponse>
  </soap:Body>
</soap:Envelope>';

    public function testStatusRequestSuccess()
    {
        $service = $this->getMockService(self::$SUCCESS_RESPONSE);

        $request = new StatusRequestType(null, 'foo-6374de7d5ed47', null);
        $response = $service->dualStatusRequestOperation($request);

        // check request
        $lastRequest = $service->__getLastRequest();
        $this->assertStringContainsString('foo-6374de7d5ed47', $lastRequest);

        $this->assertSame('foo-6374de7d5ed47', $response->getAppDeliveryID());
        $this->assertSame('132478', $response->getDualDeliveryID());
        $this->assertSame('P3', $response->getStatus()->getCode());
        $this->assertSame('InDelivery', $response->getStatus()->getText());
    }

    public function testStatusRequestDeliveryNotificationEDelivery()
    {
        $service = $this->getMockService(self::$DELIVERY_NOTIFICATION_RESPONSE_E_DELIVERY);

        $request = new StatusRequestType();
        $response = $service->dualStatusRequestOperation($request);

        $this->assertSame('887b3816-2212-434f', $response->getAppDeliveryID());
        $this->assertSame('2398411', $response->getDualDeliveryID());
        $this->assertSame('P6', $response->getStatus()->getCode());
        $this->assertSame('AllNotificationsReceived', $response->getStatus()->getText());
        $this->assertSame('I_AM_A_PDF', DualDeliveryService::getPdfFromDeliveryNotification($response));
        $this->assertSame('', DualDeliveryService::getErrorTextFromStatusResponse($response));
    }

    public function testStatusRequestDeliveryNotificationUnclaimed()
    {
        $service = $this->getMockService(self::$DELIVERY_NOTIFICATION_RESPONSE_NOT_CLAIMED);

        $request = new StatusRequestType();
        $response = $service->dualStatusRequestOperation($request);
        $unclaimedDescription = DualDeliveryService::getDeliveryNotificationForUnclaimedDescription($response);

        $this->assertSame('P6', $response->getStatus()->getCode());
        $this->assertSame("Status: 2459 (nicht behoben)\nDate: 2023-02-14\nDelivery Area: PP 8006\nBarcode: BA00BUTU80230000000008", $unclaimedDescription);
        $this->assertSame('', DualDeliveryService::getErrorTextFromStatusResponse($response));
    }

    public function testStatusRequestErrorText()
    {
        $service = $this->getMockService(self::$ERROR_TEXT_RESPONSE);

        $request = new StatusRequestType();
        $response = $service->dualStatusRequestOperation($request);

        $this->assertSame('4c87-bcf1-fb61e8b9a208', $response->getAppDeliveryID());
        $this->assertSame('2216679', $response->getDualDeliveryID());
        $this->assertSame('P9', $response->getStatus()->getCode());
        $this->assertSame('Error', $response->getStatus()->getText());
        $this->assertSame('I am an error text.', DualDeliveryService::getErrorTextFromStatusResponse($response));
    }
}
