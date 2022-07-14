<?php
return [
    'created_at' => 'Создано',
    'updated_at' => 'Изменено',
    'faq' => [
        'name' => 'Вопрос',
        'name_en' => 'Вопрос (на английском)',
        'note' => 'Ответ',
        'note_en' => 'Ответ (на английском)',
        'good_count' => 'Вопрос. Был полезен "ДА"',
        'bad_count' => 'Вопрос. Был полезен "НЕТ"',
    ],
    'lib_specialization' => [
        'name' => 'Наименование',
        'name_en' => 'Наименование (на английском)'
    ],
    'term_of_use' => [
        'note' => 'Текст',
        'note_en' => 'Текст (на английском)',
    ],
    'users' => [
        'name' => 'ФИО',
        'login' => 'Логин',
        'lang' => 'Выбранный язык',
        'avatar_id' => 'Аватар',
        'is_blocked' => 'Заблокирован акканут',
        'is_blocked_seance' => 'Заблокирован доступ к сеансам',
        'is_doctor_approve' => 'Разрешен доступ к сеансам доктора(при регистрации)',
        'price' => 'Цена за сеанс',
        'date_b' => 'Дата рождения',
        'specializations' => 'Специализации',
        'card_data' => 'Данные карточки'
    ],
    'support' => [
        'name' => 'Заголовок',
        'note' => 'Текст вопросы',
        'from_user_id' => 'От пользователя',
        'from_user_name' => 'От пользователя',

        'file_id' => 'Вложенный файл',
        'is_closed' => 'Отвечен',
        'answer' => 'Ответ администратора',
        'answer_block' => 'Форма ответа'
    ],
    'claim_user' => [
        'from_user_id' => 'От пользователя',
        'user_id' => 'На пользователя',
        'from_user_name' => 'От пользователя',
        'user_name' => 'На пользователя',
        'note' => 'Текст жалобы',
        'file_id' => 'Вложенный файл',
        'is_done' => 'Закрыто',
        'name' => 'На пользователя'
    ],

    'record_doctor' => [
        'customer_id' => 'Посетитель',
        'doctor_id' => 'Доктор',
        'doctor_name' => 'Посетитель',
        'customer_name' => 'Доктор',
        'sum' => 'Сумма',
        'record_date' => 'Дата приема',
        'record_time' => 'Время приема',
        'record_str' => 'Дата и время приема',
        'status_id' => 'Статус',
        'status_1' => 'Создан',
        'status_2' => 'Одобрен врачом',
        'status_3' => 'В работе',
        'status_4' => 'Закончен',
        'status_5' => 'Отменено врачом',
        'status_6' => 'Отменено системой',
        'is_canceled' => 'Отменено пользователем',
        'is_moved' => 'Перенесен'
    ],

    'card_transaction' => [
        'user_id' => 'Пользователь',
        'type' => 'Тип',
        'subscription_id' => 'Id подписки',
        'record_id' => 'Id записи',
        'is_done' => 'Завершен платеж',
        'is_returned' => 'Возврат платежа',
        'sum_transaction' => 'Сумма',
        'user_name' => 'Пользователь',
        'transaction_id' => 'Номер транзакции',
        'last_request' => 'Запрос',
        'last_response' => 'Ответ',
        'returned_response' => 'Ответ при возврате'
    ],

    'subscription' => [
        'user_id' => 'Пользователь',
        'is_active' => 'Активная подписка',
        'date_e' => 'Активна до(включительно)',
        'by_month' => 'Подписка помесячная',
        'by_year' => 'Подписка погодовая',
        'type_ru' => 'Тип',
        'is_cancel_by_user' => 'Отменена пользователем',
        'is_cancel_by_system' => 'Отменена системой',
        'user_name' => 'Пользователь'
    ],

    'content_main_gallery' => [
        'cat_id' => 'Категория',
        'title' => 'Заголовок',
        'slug' => 'Текст',
        'slug_en' => 'Текст на английском',
        'title_en' => 'Заголовок на английском',
        'music_id' => 'Музыка',
        'video_id' => 'Видео',
        'image_id' => 'Картинка',
        'doctor_id' => 'Доктор',
        'type'  => 'Тип',
        'null_cat' => 'Единичный элемент',
        'need_subscription' => 'Только для подписки',
        'notification_ru'  => 'Текст уведомления на русском',
        'notification_en'  => 'Текст уведомления на английском',
        'google_drive_music' => 'Ссылка на музыку(Google Drive)',
        'google_drive_video' => 'Ссылка на видео(Google Drive)',
    ],

    'content_main_gallery_cat' => [
        'cat_id' => 'Категория',
        'title' => 'Заголовок',
        'title_en' => 'Заголовок на английском',
        'slug' => 'Текст',
        'slug_en' => 'Текст на английском',
        'music_id' => 'Музыка',
        'video_id' => 'Видео',
        'image_id' => 'Картинка',
        'doctor_id' => 'Доктор',
        'google_drive_music' => 'Ссылка на музыку(Google Drive)',
        'google_drive_video' => 'Ссылка на видео(Google Drive)',
        'type'  => 'Тип',
        'need_subscription' => 'Только для подписки'
    ],

];
