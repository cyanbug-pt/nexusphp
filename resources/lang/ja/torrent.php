<?php

return array (
  'pos_state_normal' => '普通',
  'pos_state_sticky' => 'レベル1トップ',
  'pos_state_r_sticky' => 'レベル2トップ',
  'index' => 
  array (
    'page_title' => 'シードリスト',
  ),
  'show' => 
  array (
    'page_title' => '種子の詳細',
    'basic_category' => 'タイプ',
    'basic_audio_codec' => 'オーディオエンコーディング',
    'basic_codec' => 'ビデオエンコーディング',
    'basic_media' => '中くらい',
    'basic_source' => 'ソース',
    'basic_standard' => '解決',
    'basic_team' => '制作チーム',
    'size' => 'サイズ',
    'comments_label' => 'コメント',
    'times_completed_label' => '仕上げる',
    'peers_count_label' => '仲間',
    'thank_users_count_label' => 'ありがとう',
    'numfiles_label' => '書類',
    'bookmark_yes_label' => 'すでに収集されています',
    'bookmark_no_label' => '集める',
    'reward_logs_label' => '悪魔に与える',
    'reward_yes_label' => '悪魔に与えられた',
    'reward_no_label' => '悪魔に与える',
    'download_label' => 'ダウンロード',
    'thanks_yes_label' => 'もうありがとう',
    'thanks_no_label' => 'ありがとう',
  ),
  'pick_info' => 
  array (
    'normal' => '普通',
    'hot' => '人気のある',
    'classic' => 'クラシック',
    'recommended' => '推薦する',
  ),
  'claim_already' => 'この種は主張されています',
  'no_snatch' => 'そのような種子はダウンロードされていません',
  'can_no_be_claimed_yet' => 'まだ主張することはできません',
  'claim_number_reach_user_maximum' => '請求者の最大数に達しました',
  'claim_number_reach_torrent_maximum' => '主張は最大シードカウントに達します',
  'claim_disabled' => '請求が有効ではありません',
  'operation_log' => 
  array (
    'approval_deny' => 
    array (
      'type_text' => '拒否を確認します',
      'notify_subject' => '種子のレビュー拒否',
      'notify_msg' => 'あなたの種：[url =：detail_url]：torrent_name [/url]は拒否されました：オペレーターのレビュー、理由::理由',
    ),
    'approval_allow' => 
    array (
      'type_text' => 'レビューが渡されました',
      'notify_subject' => 'シードレビューが合格しました',
      'notify_msg' => 'あなたの種子：[url =：detail_url]：torrent_name [/url]がレビューされ、承認されています：オペレーター',
    ),
    'approval_none' => 
    array (
      'type_text' => 'レビューされていないマーク',
      'notify_subject' => 'レビューされていないシードマーキング',
      'notify_msg' => 'あなたの種：[url =：detail_url]：torrent_name [/url]は、監査なし：オペレーターによってマークされています',
    ),
    'edit' => 
    array (
      'type_text' => '編集',
      'notify_subject' => '種子が編集されています',
      'notify_msg' => 'あなたの種子：[url =：detail_url]：torrent_name [/url]は編集されています：operator',
    ),
    'delete' => 
    array (
      'type_text' => '消去',
      'notify_subject' => '種子が削除されます',
      'notify_msg' => 'あなたの種子:: torrent_nameは削除されます：オペレーター',
    ),
  ),
  'owner_update_torrent_subject' => 'レビュー拒否シードの更新',
  'owner_update_torrent_msg' => 'シード：[url =：detail_url]：torrent_name [/url]は著者によって更新されており、コンプライアンスを確認して承認することができます',
  'approval' => 
  array (
    'modal_title' => 'シードレビュー',
    'status_label' => 'ステータスを確認します',
    'comment_label' => 'メモ（オプション）',
    'status_text' => 
    array (
      0 => '未検証',
      1 => '合格',
      2 => '拒否する',
    ),
    'deny_comment_show' => 'Reason :: Reasonのレビューに合格しなかった',
    'logs_label' => '監査記録',
  ),
  'show_hide_media_info' => '元のMediainfoを表示/非表示にします',
  'promotion_time_types' => 
  array (
    0 => 'グローバル',
    1 => '永続',
    2 => 'それまで',
  ),
  'paid_torrent' => '料金の種',
);
