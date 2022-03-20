@extends('layout')

@section('title', 'Главная')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <x-show.counterPanel title="Показатели службы поддержки" :counters="[
                ['col' => 4, 'val' => $stat['support']['total'], 'name' => 'Общее кол-во'],
                ['col' => 4, 'val' => $stat['support']['is_closed'], 'name' => 'Кол-во отвеченных'],
                ['col' => 4, 'val' => $stat['support']['is_note_closed'], 'name' => 'Кол-во не отвеченных'],
            ]"  />
        </div>
        <div class="col-md-6">
            <x-show.counterPanel title="Показатели жалоб" :counters="[
                ['col' => 4, 'val' => $stat['claim']['total'], 'name' => 'Общее кол-во'],
                ['col' => 4, 'val' => $stat['claim']['is_closed'], 'name' => 'Кол-во закрытых'],
                ['col' => 4, 'val' => $stat['claim']['is_closed_note'], 'name' => 'Кол-во открытых'],
            ]"  />
        </div>
        <div class="col-md-6">
            <x-show.counterPanel title="Показатели докторов" :counters="[
                ['col' => 4, 'val' => $stat['doctor']['total'], 'name' => 'Общее кол-во'],
                ['col' => 4, 'val' => $stat['doctor']['is_blocked'], 'name' => 'Кол-во заблокированных аккаунтов'],
                ['col' => 4, 'val' => $stat['doctor']['is_blocked_seance'], 'name' => 'Кол-во закрытых к сеансам'],
            ]"  />
        </div>
        <div class="col-md-6">
            <x-show.counterPanel title="Показатели пользователей" :counters="[
                ['col' => 4, 'val' => $stat['customers']['total'], 'name' => 'Общее кол-во'],
                ['col' => 4, 'val' => $stat['customers']['is_blocked'], 'name' => 'Кол-во заблокированных аккаунтов'],
                ['col' => 4, 'val' => $stat['customers']['is_blocked_seance'], 'name' => 'Кол-во закрытых к сеансам'],
            ]"  />
        </div>
    </div>


    <x-show.counterPanel title="Показатели подписок" :counters="[
        ['col' => 2, 'val' => $stat['subscription']['total'], 'name' => 'Общее кол-во'],
        ['col' => 2, 'val' => $stat['subscription']['is_active'], 'name' => 'Кол-во активных'],
        ['col' => 4, 'val' => $stat['subscription']['is_active_note'], 'name' => 'Кол-во неактивных'],
        ['col' => 2, 'val' => $stat['subscription']['is_cancel_by_user'], 'name' => 'Кол-во отмененных пользователем'],
        ['col' => 2, 'val' => $stat['subscription']['is_cancel_by_system'], 'name' => 'Кол-во отмененных системой'],
    ]"  />

    <x-show.counterPanel title="Показатели записей" :counters="[
        ['col' => 4, 'val' => $stat['record']['total'], 'name' => 'Общее кол-во'],
        ['col' => 4, 'val' => $stat['record']['is_canceled'], 'name' => 'Кол-во отмененных пользователем'],
        ['col' => 4, 'val' => $stat['record']['is_moved'], 'name' => 'Кол-во перемешенных пользователем'],
        ['col' => 4, 'val' => $stat['record']['ar_status'][1], 'name' => 'Кол-во записей со статусом \'Создан\''],
        ['col' => 4, 'val' => $stat['record']['ar_status'][2], 'name' => 'Кол-во записей со статусом \'Одобрен врачом\''],
        ['col' => 4, 'val' => $stat['record']['ar_status'][3], 'name' => 'Кол-во записей со статусом \'В работе\''],
        ['col' => 4, 'val' => $stat['record']['ar_status'][4], 'name' => 'Кол-во записей со статусом \'Закончен\''],
        ['col' => 4, 'val' => $stat['record']['ar_status'][5], 'name' => 'Кол-во записей со статусом \'Отменено врачом\''],
        ['col' => 4, 'val' => $stat['record']['ar_status'][6], 'name' => 'Кол-во записей со статусом \'Отменено системой\''],
    ]"  />

    <x-show.counterPanel title="Показатели финансов" :counters="[
        ['col' => 6, 'val' => $stat['finance']['total_count'], 'name' => 'Общее кол-во'],
        ['col' => 6, 'val' => $stat['finance']['total_sum'], 'name' => 'Общая сумма'],
        ['col' => 3, 'val' => $stat['finance']['is_done_count'], 'name' => 'Общее кол-во успешно закрытых'],
        ['col' => 3, 'val' => $stat['finance']['is_done_sum'], 'name' => 'Общая сумма успешно закрытых'],
        ['col' => 3, 'val' => $stat['finance']['is_returned_count'], 'name' => 'Общее кол-во возвращенных'],
        ['col' => 3, 'val' => $stat['finance']['is_returned_sum'], 'name' => 'Общая сумма кол-во возвращенных'],
    ]"  />



@endsection
