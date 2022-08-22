<script>
    "use strict";
    const config = {
        lang: "{{ getLang() }}",
        baseURL: "{{ url('/') }}",
        countryCode: "{{ vIpInfo()->country_code == 'Unknown' ? 'US' : vIpInfo()->country_code }}",
        primaryColor: "{{ $settings['website_primary_color'] }}",
        secondaryColor: "{{ $settings['website_secondary_color'] }}",
        alertActionTitle: "{{ lang('Are you sure?') }}",
        alertActionText: "{{ lang('Confirm that you want do this action') }}",
        alertActionConfirmButton: "{{ lang('Confirm') }}",
        alertActionCancelButton: "{{ lang('Cancel') }}",
        copiedToClipboardSuccess: "{{ lang('Copied to clipboard') }}",
        LoadingOverlayColor: "{{ $settings['website_primary_color'] }}",
    };
    let configObjects = JSON.stringify(config),
        getConfig = JSON.parse(configObjects);
</script>
@stack('config')
