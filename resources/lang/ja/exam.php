<?php

return [
    'label' => '試験',
    'name' => '試験名',
    'index' => '試験インデックス',
    'time_range' => '試験時間',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => '増分をアップロード',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'シード時間平均',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => '増分をダウンロード',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'ボーナスインクリメント',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Seed points increment',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Torrent の増分をアップロード',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'ユーザクラス',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => '時間範囲の登録',
        \App\Models\Exam::FILTER_USER_DONATE => '寄付済み',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => '登録日の範囲',
    ],
    'require_value' => '必須',
    'current_value' => '現在',
    'result' => '結果',

    'result_pass_for_exam' => '合格！',
    'result_pass_for_task' => '完了！',
    'result_not_pass_for_exam' => '<span style="color: red">合格していません！</span>',
    'result_not_pass_for_task' => '<span style="color: red">未完了！</span>',
    'checkout_pass_message_subject_for_exam' => '試験合格！',
    'checkout_pass_message_content_for_exam' => 'おめでとうございます！時間内に:exam_name(:begin ~ :end) に合格しました。',
    'checkout_not_pass_message_subject_for_exam' => '試験に合格していないため、アカウントは禁止されています！',
    'checkout_not_pass_message_content_for_exam' => '試験に合格しませんでした: 時間内に:exam_name (:begin ~ :end) あなたのアカウントは禁止されています！',

    'checkout_pass_message_subject_for_task' => 'タスク完了！',
    'checkout_pass_message_content_for_task' => 'おめでとうございます! タスクを完了しました: :exam_name in time(:begin ~ :end), got bonus: :success_reward_bonce',
    'checkout_not_pass_message_subject_for_task' => 'タスクが完了していません。',
    'checkout_not_pass_message_content_for_task' => 'タスクを完了しないようにしてください: :exam_name in time (:begin ~ :end)、ボーナスを差し引いてください: :fail_deduct_bonus',

    'ban_log_reason' => 'テストが完了していません: :exam_name in time(:begin ~ :end)',
    'ban_user_modcomment' => 'テストが完了していないため: :exam_name(:begin ~ :end)、システムによるBAN。',
    'admin' => [
        'list' => [
            'page_title' => '試験一覧'
        ]
    ],
    'recurring' => '繰り返し',
    'recurring_daily' => '1日に一度',
    'recurring_weekly' => '週に一度',
    'recurring_monthly' => '月に1回',
    'recurring_help' => '定期的に指定された場合、試験の開始時刻は現在のサイクルの開始時刻です。 そして、ここで述べたように、すべての自然な日/週/月である、現在のサイクルの終了時間です。 タイプが試験の場合、各サイクルの終わりに、ユーザーがまだスクリーニング基準を満たしている場合。 次の周期のために自動的に試験が割り当てられます' ,

    'time_condition_invalid' => '時間パラメータは意味をなさない、3つの項目のうちの1つだけがあります: 開始時間+終了時間/期間/定期的な',

    'type_exam' => '試験',
    'type_task' => 'タスク',
    'type' => 'タイプ',
    'type_help' => '試験は通常の試験であり、失敗するとアカウントの禁止になります。 タスクは報酬ボーナスに設定できます。完了しているかどうかによってボーナスを差し引くことができます。',

    'fail_deduct_bonus' => '失敗のための控除ボーナス',
    'success_reward_bonus' => '完了のボーナスボーナス',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => '請求しますか？' ,
    'claim_by_yourself_only' => '自分だけで要求しよう！' ,
    'not_match_target_user' => '一致するターゲットユーザーではありません！' ,
    'has_other_on_the_way' => '他の :type_text が進行中です！' ,
    'claimed_already' => '既に受け取っています',
    'not_between_begin_end_time' => '開始時間と終了時間の間ではありません',
    'reach_max_user_count' => '要求されたユーザーの数が上限に達しました',
    'claimed_user_count' => '請求済み',
    'max_user_count' => '最大請求ユーザー数（0は無制限）',
    'background_color' => '情報ボックスの背景色',
];
