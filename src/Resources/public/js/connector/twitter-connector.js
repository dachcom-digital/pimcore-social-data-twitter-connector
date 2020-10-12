pimcore.registerNS('SocialData.Connector.Twitter');
SocialData.Connector.Twitter = Class.create(SocialData.Connector.AbstractConnector, {

    hasCustomConfiguration: function () {
        return true;
    },

    getCustomConfigurationFields: function () {

        var data = this.customConfiguration;

        return [
            {
                trackResetOnLoad: true,
                xtype: 'textfield',
                name: 'apiKey',
                fieldLabel: 'API Key',
                allowBlank: false,
                value: data.hasOwnProperty('apiKey') ? data.apiKey : null
            },
            {
                trackResetOnLoad: true,
                xtype: 'textfield',
                name: 'apiSecretKey',
                fieldLabel: 'API Secret Key',
                allowBlank: false,
                value: data.hasOwnProperty('apiSecretKey') ? data.apiSecretKey : null
            },
            {
                trackResetOnLoad: true,
                xtype: 'textfield',
                name: 'accessToken',
                fieldLabel: 'Access Token',
                allowBlank: false,
                value: data.hasOwnProperty('accessToken') ? data.accessToken : null
            },
            {
                trackResetOnLoad: true,
                xtype: 'textfield',
                name: 'accessTokenSecret',
                fieldLabel: 'Access Token Secret',
                allowBlank: false,
                value: data.hasOwnProperty('accessTokenSecret') ? data.accessTokenSecret : null
            }
        ];
    }
});
