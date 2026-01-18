    'default-sp' => [
        'saml:SP',

        // The entity ID of this SP.
        'entityID' => 'https://wiki.mnky.site/',

        // The entity ID of the IdP this SP should contact.
        // Can be NULL/unset, in which case the user will be shown a list of available IdPs.
        'idp' => 'https://sts.windows.net/4e0ee069-1191-4ba0-9ac1-ac18788f71b8/',

        // The URL to the discovery service.
        // Can be NULL/unset, in which case a builtin discovery service will be used.
        'discoURL' => null,
        'NameIDFormat' => 'urn:oasis:name:tc:SAML:2.0:nameid-format:persistent', 'simplesaml.nameidattribute' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/upn',
