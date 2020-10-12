pimcore.registerNS('SocialData.Feed.Twitter');
SocialData.Feed.Twitter = Class.create(SocialData.Feed.AbstractFeed, {

    panel: null,

    getLayout: function () {

        this.panel = new Ext.form.FormPanel({
            title: false,
            defaults: {
                labelWidth: 200
            },
            items: this.getConfigFields()
        });

        return this.panel;
    },

    getConfigFields: function () {

        var fields = [];

        fields.push(
            {
                xtype: 'textfield',
                value: this.data !== null ? this.data['screenName'] : null,
                fieldLabel: 'Screen name',
                name: 'screenName',
                labelAlign: 'left',
                anchor: '100%',
                flex: 1
            },
            {
                xtype: 'numberfield',
                value: this.data !== null ? this.data['count'] : null,
                fieldLabel: 'Count',
                name: 'count',
                maxValue: 500,
                minValue: 0,
                labelAlign: 'left',
                anchor: '100%',
                flex: 1
            },
            {
                xtype: 'checkboxfield',
                value: this.data !== null ? this.data['ignoreReplies'] : null,
                fieldLabel: 'Ignore replies',
                name: 'ignoreReplies',
                labelAlign: 'left',
                anchor: '100%',
                flex: 1
            },
            {
                xtype: 'checkboxfield',
                value: this.data !== null ? this.data['ignoreRetweets'] : null,
                fieldLabel: 'Ignore retweets',
                name: 'ignoreRetweets',
                labelAlign: 'left',
                anchor: '100%',
                flex: 1
            }
        );

        return fields;
    },

    isValid: function () {
        return this.panel.form.isValid();
    },

    getValues: function () {
        return this.panel.form.getValues();
    }
});
