<?php

use function PHPSTORM_META\map;

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

    'accepted' => ':attribute يجب أن يكون مقبولاً',
    'accepted_if' => ':attribute يجب أن يكون مقبولاً عندما يكون :other قيمته :value',
    'active_url' => ':attribute ليس رابطاً صالحاً',
    'after' => ':attribute يجب أن يكون تاريخاً بعد :date',
    'after_or_equal' => ':attribute يجب أن يكون تاريخاً بعد أو مطابق ل :date',
    'alpha' => ':attribute يجب أن يحتوي فقط حروفاً',
    'alpha_dash' => ':attribute يجب أن يحتوي فقط على أحرف وأرقام وشرطات وشرطات سفلية',
    'alpha_num' => ':attribute يجب أن يحتوي فقط على أحرف وأرقام',
    'array' => ':attribute يجب أن يكون مصفوفة',
    'ascii' => ':attribute يجب أن يحتوي فقط على أحرف ورموز أبجدية وأرقام',
    'before' => ':attribute يجب أن يكون تاريخاً قبل :date',
    'before_or_equal' => ':attribute يجب أن يكون تاريخاً قبل أو مطابق ل :date',
    'between' => [
        'array' => ':attribute يجب أن يحتوي بين :min و :max من العناصر',
        'file' => ':attribute يجب أن يكون حجمه بين :min و :max كيلو بايت',
        'numeric' => ':attribute يجب أن يكون بين :min و :max',
        'string' => ':attribute يجب أن يحتوي بين :min و :max من الأحرف',
    ],
    'boolean' => ':attribute يجب أن يكون true أو false',
    'confirmed' => ':attribute غير متطابق',
    'current_password' => 'كلمة السر غير صحيحة',
    'date' => ':attribute ليس تاريخاً صحيحاً',
    'date_equals' => ':attribute يجب أن يكون تاريخاً مطابقاً ل :date',
    'date_format' => ':attribute غير مطابق للشكل المطلوب :format',
    'decimal' => ':attribute يجب أن يكون به :decimal من الخانات العشرية',
    'declined' => ':attribute يجب أن يكون مرفوضاً',
    'declined_if' => ':attribute يجب أن يكون مرفوضاً عندما يكون :other قيمته :value',
    'different' => ':attribute و :other يجب أن يكونوا مختلفين',
    'digits' => ':attribute يجب أن يحتوي على :digits من الأرقام',
    'digits_between' => ':attribute يجب أن يحتوي بين :min و :max رقم',
    'dimensions' => ':attribute لها أبعاد غير متطابقة',
    'distinct' => ':attribute قيمته مكررة',
    'doesnt_end_with' => ':attribute ربما لا ينتهي بأحد القيم التالية: :values',
    'doesnt_start_with' => ':attribute ربما لا يبدأ بأحد القيم التالية: :values',
    'email' => ':attribute يجب أن يكون صالحاً',
    'ends_with' => ':attribute يجب أن ينتهي بأحد القيم التالية: :values',
    'enum' => ':attribute غير صالح',
    'exists' => ':attribute غير صالح',
    'file' => ':attribute يجب أن يكون ملفاً',
    'filled' => ':attribute يجب أن يحتوي على قيمة',
    'gt' => [
        'array' => ':attribute يجب أن يحتوي على أكثر من :value من العناصر',
        'file' => ':attribute يجب أن يكون أكبر من :value كبلو بايت',
        'numeric' => ':attribute يجب أن يكون أكبر من :value',
        'string' => ':attribute يجب أن يحتوي على أكثر من :value من الأحرف',
    ],
    'gte' => [
        'array' => ':attribute يجب أن يحتوي على :value من العناصر أو أكثر',
        'file' => ':attribute يجب أن يكون حجمه :value كيلو بايت أو أكثر',
        'numeric' => ':attribute يجب أن يكون مساوياً أو أكبر من :value',
        'string' => ':attribute يجب أن يحتوي على :value من الأحرف أو أكثر',
    ],
    'image' => ':attribute يجب أن يكون صورة',
    'in' => ':attribute غير صالح',
    'in_array' => ':attribute غير موجود بالعناصر التالية :other',
    'integer' => ':attribute يجب أن يكون رقم صحيح',
    'ip' => ':attribute يجب أن يكون عنوان IP صالح',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صالح',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صالح',
    'json' => ':attribute  يجب أن يكون JSON',
    'lowercase' => ':attribute يجب أن يكون أحرف صغيرة',
    'lt' => [
        'array' => ':attribute يجب أن يحتوي على أقل من :value من العناصر',
        'file' => ':attribute يجب أن يكون أقل من :value كيلو بايت',
        'numeric' => ':attribute يجب أن يكون أقل من :value',
        'string' => ':attribute يجب أن يحتوي على أقل من :value من الأحرف',
    ],
    'lte' => [
        'array' => ':attribute يجب أن يحتوي على :value من العناصر أو أقل',
        'file' => ':attribute يجب أن يكون حجمه :value كيلو بايت أو أقل',
        'numeric' => ':attribute يجب أن يكون مساوياً أو أقل من :value',
        'string' => ':attribute يجب أن يحتوي على :value من الأحرف أو أقل',
    ],
    'mac_address' => ':attribute يجب أن يكون عنوان MAC صالح',
    'max' => [
        'array' => ':attribute يجب ألا يحتوي على أكثر من :max من العناصر',
        'file' => ':attribute يجب ألا يكون أكبر من :max كيلو بايت',
        'numeric' => ':attribute يجب ألا يكون أكبر من :max',
        'string' => ':attribute يجب ألا يحتوي على أكثر من :max من الأحرف',
    ],
    'max_digits' => ':attribute يجب ألا يحتوي على أكثر من :max من الأرقام',
    'mimes' => ':attribute يجب أن يكون ملف من نوع: :values',
    'mimetypes' => ':attribute يجب أن يكون ملف من نوع: :values',
    'min' => [
        'array' => ':attribute يجب أن يحتوي على أقل من :min من العناصر',
        'file' => ':attribute يجب ألا يكون أقل من :min كيلو بايت',
        'numeric' => ':attribute يجب ألا يكون أقل من :min',
        'string' => ':attribute يجب ألا يحتوي على أقل من :min من الأحرف',
    ],
    'min_digits' => ':attribute يجب أن يحتوي على الأقل على :min من الأرقام',
    'multiple_of' => ':attribute يجب أن يكون من مضاعفات :value',
    'not_in' => ':attribute غير صالح',
    'not_regex' => ':attribute شكله غير صالح',
    'numeric' => ':attribute يجب أن يكون رقماً',
    'password' => [
        'letters' => ':attribute يجب أن يحتوي على حرف على الأقل',
        'mixed' => ':attribute يجب أن يحتوي على الأقل على حرف كبير وحرف صغير',
        'numbers' => ':attribute يجب أن يحتوي على رقم على الأقل',
        'symbols' => ':attribute يجب أن يحتوي على رمز على الأقل',
        'uncompromised' => ':attribute المدخل ظهر في البيانات المسربة الرجاء إدخال واحداً مختلفاً',
    ],
    'present' => ':attribute يجب أن يكون موجوداً',
    'prohibited' => ':attribute ممنوع',
    'prohibited_if' => ':attribute ممنوع عندما يكون :other قيمته :value',
    'prohibited_unless' => ':attribute ممنوع ما لم يكون :other في هذه القيم :values',
    'prohibits' => ':attribute يمنع :other من أن تكون موجودة',
    'regex' => ':attribute شكله غير صالح',
    'required' => 'يجب إدخال :attribute',
    'required_array_keys' => ':attribute يجب أن يحتوي على المدخلات التالية: :values',
    'required_if' => ':attribute مطلوب عندما يكون :other قيمته :value',
    'required_if_accepted' => ':attribute مطلوب عندما يكون :other مقبول',
    'required_unless' => ':attribute مطلوب ما لم يكون :other في هذه القيم :values',
    'required_with' => ':attribute مطلوب عندما تكون :values موجودة',
    'required_with_all' => ':attribute مطلوب عندما تكون :values موجودة',
    'required_without' => ':attribute مطلوب عندما تكون :values غير موجودة',
    'required_without_all' => ':attribute مطلوب عندما لا تكون أحد هذه القيم :values موجودة',
    'same' => ':attribute و :other يجب أن يتطابقا',
    'size' => [
        'array' => ':attribute يجب أن يحتوي على :size من العناصر',
        'file' => ':attribute يجب أن يساوي :size كيلو بايت',
        'numeric' => ':attribute يجب أن يساوي :size',
        'string' => ':attribute يجب أن يحتوي على :size من الأحرف',
    ],
    'starts_with' => ':attribute يجب أن يبدأ بأحد القيم التالية: :values',
    'string' => ':attribute يجب أن يحتوي على أحرف أو أرقام',
    'timezone' => ':attribute يجب أن تكون منطقة زمنية صالحة',
    'unique' => ':attribute مستخدم من قبل',
    'uploaded' => ':attribute فشل التحميل',
    'uppercase' => ':attribute يجب أن يكون أحرف كبيرة',
    'url' => ':attribute يجب أن يكون URL صالح',
    'ulid' => ':attribute يجب أن يكون ULID صالح',
    'uuid' => ':attribute يجب أن يكون UUID صالح',
    'invalid_credentials' => 'بيانات التسجيل غير صحيحة',
    


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
        'name' => 'الاسم',
        'date' => 'التاريخ',
        'countDays' => 'عدد الايام',
        'company_id' => 'اسم الشركة',
        'category_id' => 'تصنيف المهمة',
        'admin_id' => 'المشرف',
        'employee_id' => 'الموظف',
        'file' => 'ملف المهمة',
        'timeMorning' => 'التذكيرات',
        'timeEvening' => 'الفترة المسائية',
    ],

];
