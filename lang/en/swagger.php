<?php
return [
    'tag' => [
        'v1Auth' => 'Auth',
        'DoctorDoctorProfile' => 'DoctorProfile',
        'v1Registration' => 'Registration',
        'v1RestorePassword' => 'RestorePassword',
        'MainSupport' => 'Support',
        'MainFaq' => 'Faq',
        'MainLibSpecialization' => 'LibSpecialization',
        'MainTermOfUse' => 'TermOfUse',
        'DoctorDoctorTimetablePlan' => 'DoctorTimetablePlan',
        'DoctorDoctorSpecialization' => 'DoctorSpecialization',
        'DoctorDoctorVideo' => 'DoctorVideo',
        'DoctorDoctorCertificat' => 'DoctorCertificat',
        'UserUserProfile' => 'UserProfile',
        'MainDoctor' => 'SearchDoctor',
        'MainClaim' => 'Claim'
    ],
    'path' => [
        'auth' => [
            'login' => 'Логин',
            'logout' => 'Выход'
        ],
        'restore-password' => [
            'step1' => 'Шаг 1. Ишу номер. Может вернуть ошибку если номера нет',
            'step2' => 'Шаг 2. Проверка пин-а. Может вернуть ошибку если нет номера или пин не сходиться',
            'step3' => 'Шаг 3. Смена пароля. Может вернуть ошибку если нет номера или пин не сходиться. После этого шага можна входить по новому паролю',
        ]
    ],
    'param' => [
        'auth' => [
            'login' => [
                'login' => 'Логин. В виде номера через цифры',
                'password' => 'Пароль'
            ]
        ],
        'restore-password' => [
            'step1' => [
                'login' => 'Телефон'
            ],
            'step2' => [
                'login' => 'Телефон',
                'pin' => 'Пин. по дефолту 123456'
            ],
            'step3' => [
                'login' => 'Телефон',
                'pin' => 'Пин. по дефолту 123456',
                'password' => 'Пароль. не больше 255 символов',
                're_password' => 'Повтор пароля. Не больше 255 символов. Если не сходиться вернет ошибку'
            ]
        ]
    ]
];