<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */

    'accepted' => lang('The :attribute must be accepted.', 'validation'),
    'accepted_if' => lang('The :attribute must be accepted when :other is :value.', 'validation'),
    'active_url' => lang('The :attribute is not a valid URL.', 'validation'),
    'after' => lang('The :attribute must be a date after :date.', 'validation'),
    'after_or_equal' => lang('The :attribute must be a date after or equal to :date.', 'validation'),
    'alpha' => lang('The :attribute must only contain letters.', 'validation'),
    'alpha_dash' => lang('The :attribute must only contain letters, numbers, dashes and underscores.', 'validation'),
    'alpha_num' => lang('The :attribute must only contain letters and numbers.', 'validation'),
    'array' => lang('The :attribute must be an array.', 'validation'),
    'before' => lang('The :attribute must be a date before :date.', 'validation'),
    'before_or_equal' => lang('The :attribute must be a date before or equal to :date.', 'validation'),
    'between' => [
        'numeric' => lang('The :attribute must be between :min and :max.', 'validation'),
        'file' => lang('The :attribute must be between :min and :max kilobytes.', 'validation'),
        'string' => lang('The :attribute must be between :min and :max characters.', 'validation'),
        'array' => lang('The :attribute must have between :min and :max items.', 'validation'),
    ],
    'boolean' => lang('The :attribute field must be true or false.', 'validation'),
    'confirmed' => lang('The :attribute confirmation does not match.', 'validation'),
    'current_password' => lang('The password is incorrect.', 'validation'),
    'date' => lang('The :attribute is not a valid date.', 'validation'),
    'date_equals' => lang('The :attribute must be a date equal to :date.', 'validation'),
    'date_format' => lang('The :attribute does not match the format :format.', 'validation'),
    'different' => lang('The :attribute and :other must be different.', 'validation'),
    'digits' => lang('The :attribute must be :digits digits.', 'validation'),
    'digits_between' => lang('The :attribute must be between :min and :max digits.', 'validation'),
    'dimensions' => lang('The :attribute has invalid image dimensions.', 'validation'),
    'distinct' => lang('The :attribute field has a duplicate value.', 'validation'),
    'email' => lang('The :attribute must be a valid email address.', 'validation'),
    'ends_with' => lang('The :attribute must end with one of the following: :values.', 'validation'),
    'exists' => lang('The selected :attribute is invalid.', 'validation'),
    'file' => lang('The :attribute must be a file.', 'validation'),
    'filled' => lang('The :attribute field must have a value.', 'validation'),
    'gt' => [
        'numeric' => lang('The :attribute must be greater than :value.', 'validation'),
        'file' => lang('The :attribute must be greater than :value kilobytes.', 'validation'),
        'string' => lang('The :attribute must be greater than :value characters.', 'validation'),
        'array' => lang('The :attribute must have more than :value items.', 'validation'),
    ],
    'gte' => [
        'numeric' => lang('The :attribute must be greater than or equal :value.', 'validation'),
        'file' => lang('The :attribute must be greater than or equal :value kilobytes.', 'validation'),
        'string' => lang('The :attribute must be greater than or equal :value characters.', 'validation'),
        'array' => lang('The :attribute must have :value items or more.', 'validation'),
    ],
    'image' => lang('The :attribute must be an image.', 'validation'),
    'in' => lang('The selected :attribute is invalid.', 'validation'),
    'in_array' => lang('The :attribute field does not exist in :other.', 'validation'),
    'integer' => lang('The :attribute must be an integer.', 'validation'),
    'ip' => lang('The :attribute must be a valid IP address.', 'validation'),
    'ipv4' => lang('The :attribute must be a valid IPv4 address.', 'validation'),
    'ipv6' => lang('The :attribute must be a valid IPv6 address.', 'validation'),
    'json' => lang('The :attribute must be a valid JSON string.', 'validation'),
    'lt' => [
        'numeric' => lang('The :attribute must be less than :value.', 'validation'),
        'file' => lang('The :attribute must be less than :value kilobytes.', 'validation'),
        'string' => lang('The :attribute must be less than :value characters.', 'validation'),
        'array' => lang('The :attribute must have less than :value items.', 'validation'),
    ],
    'lte' => [
        'numeric' => lang('The :attribute must be less than or equal :value.', 'validation'),
        'file' => lang('The :attribute must be less than or equal :value kilobytes.', 'validation'),
        'string' => lang('The :attribute must be less than or equal :value characters.', 'validation'),
        'array' => lang('The :attribute must not have more than :value items.', 'validation'),
    ],
    'max' => [
        'numeric' => lang('The :attribute must not be greater than :max.', 'validation'),
        'file' => lang('The :attribute must not be greater than :max kilobytes.', 'validation'),
        'string' => lang('The :attribute must not be greater than :max characters.', 'validation'),
        'array' => lang('The :attribute must not have more than :max items.', 'validation'),
    ],
    'mimes' => lang('The :attribute must be a file of type: :values.', 'validation'),
    'mimetypes' => lang('The :attribute must be a file of type: :values.', 'validation'),
    'min' => [
        'numeric' => lang('The :attribute must be at least :min.', 'validation'),
        'file' => lang('The :attribute must be at least :min kilobytes.', 'validation'),
        'string' => lang('The :attribute must be at least :min characters.', 'validation'),
        'array' => lang('The :attribute must have at least :min items.', 'validation'),
    ],
    'multiple_of' => lang('The :attribute must be a multiple of :value.', 'validation'),
    'not_in' => lang('The selected :attribute is invalid.', 'validation'),
    'not_regex' => lang('The :attribute format is invalid.', 'validation'),
    'numeric' => lang('The :attribute must be a number.', 'validation'),
    'password' => lang('The password is incorrect.', 'validation'),
    'present' => lang('The :attribute field must be present.', 'validation'),
    'regex' => lang('The :attribute format is invalid.', 'validation'),
    'required' => lang('The :attribute field is required.', 'validation'),
    'required_if' => lang('The :attribute field is required when :other is :value.', 'validation'),
    'required_unless' => lang('The :attribute field is required unless :other is in :values.', 'validation'),
    'required_with' => lang('The :attribute field is required when :values is present.', 'validation'),
    'required_with_all' => lang('The :attribute field is required when :values are present.', 'validation'),
    'required_without' => lang('The :attribute field is required when :values is not present.', 'validation'),
    'required_without_all' => lang('The :attribute field is required when none of :values are present.', 'validation'),
    'prohibited' => lang('The :attribute field is prohibited.', 'validation'),
    'prohibited_if' => lang('The :attribute field is prohibited when :other is :value.', 'validation'),
    'prohibited_unless' => lang('The :attribute field is prohibited unless :other is in :values.', 'validation'),
    'prohibits' => lang('The :attribute field prohibits :other from being present.', 'validation'),
    'same' => lang('The :attribute and :other must match.', 'validation'),
    'size' => [
        'numeric' => lang('The :attribute must be :size.', 'validation'),
        'file' => lang('The :attribute must be :size kilobytes.', 'validation'),
        'string' => lang('The :attribute must be :size characters.', 'validation'),
        'array' => lang('The :attribute must contain :size items.', 'validation'),
    ],
    'starts_with' => lang('The :attribute must start with one of the following: :values.', 'validation'),
    'string' => lang('The :attribute must be a string.', 'validation'),
    'timezone' => lang('The :attribute must be a valid timezone.', 'validation'),
    'unique' => lang('The :attribute has already been taken.', 'validation'),
    'uploaded' => lang('The :attribute failed to upload.', 'validation'),
    'url' => lang('The :attribute must be a valid URL.', 'validation'),
    'uuid' => lang('The :attribute must be a valid UUID.', 'validation'),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
     */

    'attributes' => [
        'g-recaptcha-response' => lang('captcha', 'forms'),
    ],

];
