$wgPluggableAuth_Class = 'SimpleSAMLphp';


wfLoadExtension( 'SimpleSAMLphp' );
$wgSimpleSAMLphp_InstallDir = '/var/simplesamlphp';
$wgSimpleSAMLphp_AuthSourceId = 'default-sp';
#$wgSimpleSAMLphp_UsernameAttribute = ['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname','http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname'];
#$wgSimpleSAMLphp_RealNameAttribute = [
#        'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname',
#        'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname'
#];
$wgSimpleSAMLphp_MandatoryUserInfoProviders['custom_full_name'] = [
    'factory' => function() {
        return new \MediaWiki\Extension\SimpleSAMLphp\UserInfoProvider\GenericCallback(
            function( $attributes ) {
                $first = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname';
                $last = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname';

                if ( empty( $attributes[$first] ) || empty( $attributes[$last] ) ) {
                    throw new Exception( 'Missing name attributes in SAML assertion.' );
                }

                // Returns "First Last"
                return $attributes[$first][0] . ' ' . $attributes[$last][0];
            }
        );
    }
];

$wgPluggableAuth_Config['Login with Azure AD'] = [
    'plugin' => 'SimpleSAMLphp',
    'data' => [
        'authSourceId' => 'default-sp',
	'emailAttribute' =>  'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name',
	'userinfoProviders' => [
            'username' => 'custom_full_name',
            'realname' => 'custom_full_name'
    ]
    ]
];
$wgShowExceptionDetails = true;
$wgPluggableAuth_AllowLogoutWithoutCookie = true;
$wgHooks['SkinTemplateNavigation::Universal'][] = function( $sktemplate, &$links ) {
    if ( isset( $links['user-menu']['logout'] ) ) {
        // Ensure standard logout is available
        $links['user-menu']['custom-logout'] = $links['user-menu']['logout'];
    }
};
