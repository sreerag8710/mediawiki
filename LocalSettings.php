// Load extensions
wfLoadExtensions( [
    'PluggableAuth',
    'LDAPProvider',
    'LDAPAuthentication2',
    'LDAPAuthorization', // optional
    'LDAPUserInfo'      // optional
] );

// Path to your LDAP JSON config (outside webroot for security)
$LDAPProviderDomainConfigs = "/var/www/ldapprovider.json";

#$wgLDAPAuthentication2AllowLocalLogin = false;
$wgLDAPAuthentication2DomainConfigs = [
    'lab.local' => [
        'provider' => 'ldap',
        'domain'   => 'lab.local',
    ]
];

$wgPluggableAuth_Config['Log In (LDAP)'] = [
    'plugin' => 'LDAPAuthentication2',
    'data' => [
        'domain' => 'lab.local'
    ]
];

$wgGroupPermissions['*']['autocreateaccount'] = true;
$wgShowExceptionDetails = true;

$wgDebugLogGroups['LDAP'] = "/var/log/mediawiki/ldap.log";
$wgDebugLogGroups['PluggableAuth'] = "/var/log/mediawiki/pluggableauth.log";
$wgDebugLogGroups['LDAPProvider'] = "/var/log/mediawiki/ldapprovider.log";
$wgDebugLogGroups['LDAPAuthentication2'] = "/var/log/mediawiki/ldapauth.log";
$wgDebugLogGroups['LDAPAuthorization'] = "/var/log/mediawiki/ldapauthor.log";


$wgLDAPProviderDefaultOptions = [
    LDAP_OPT_REFERRALS => 0
];
