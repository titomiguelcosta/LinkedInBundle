Zorbus LinkedIn Bundle
======================

A Symfony Bundle that integrates the Zorbus LinkedIn Library.

Configuration
-------------

Add to the config.yml the following parameters with your LinkedIn application values:

zorbus_linked_in:
    key: TheKeY
    secret: ThEsECReT
    scope: r_basicprofile,r_fullprofile

And add the routes to routing.yml

zorbus_linked_in:
    resource: "@ZorbusLinkedInBundle/Resources/config/routing.yml"
    prefix: /linkedin