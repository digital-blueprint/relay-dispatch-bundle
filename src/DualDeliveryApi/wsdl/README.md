Duale_Zustellung_-_Schnittstellenspezifikation_1.0.3:

https://neu.ref.wien.gv.at/at.gv.wien.ref-live/web/reference-server/elkat?p_p_id=20&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&_20_struts_action=%2Fdocument_library%2Fview_file_entry&_20_redirect=https%3A%2F%2Fneu.ref.wien.gv.at%2Fat.gv.wien.ref-live%2Fweb%2Freference-server%2Felektronische-zustellung%3Fp_p_id%3D3%26p_p_lifecycle%3D0%26p_p_state%3Dmaximized%26p_p_mode%3Dview%26_3_groupId%3D0%26_3_keywords%3Dduale%26_3_struts_action%3D%252Fsearch%252Fsearch&_20_fileEntryId=52150

Changes to the WSDL files compared to the above version (also see the git history):

* Removed the "StatusRequestType" type from "DualeZustellung.xsd".
  It is unused and the PHP SOAP client doesn't handle namespaces correctly which leads to conflicts with the
  "StatusRequestType" in "DualeZustellung_Notification.xsd". An alternative might be to create separate wsdl files
  for the different services which only import the .xsd files that are needed (preaddr, request, notify, etc)
  to avoid conflicts. In this case just removing the unused type seemed like the easiest solution.

* Removed the "NotificationChannelSet" reference in NotificationChannel and replaced it
  with a "choice" for the possible subclasses.
  For some reason php-soap can't decode such responses, maybe because it is using
  substitutionGroup and is unsupported.