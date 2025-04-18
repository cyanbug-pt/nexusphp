<?php

return array (
  'type_text' => 
  array (
    1 => 'ユーザー',
    2 => '管理者',
  ),
  'status_text' => 
  array (
    0 => 'レビューされていません',
    1 => '合格した',
    2 => '拒否された',
  ),
  'status_change_message' => 
  array (
    'subject' => 'シードボックスレコードステータスの変更',
    'body' => 'ID：IDのシードボックスの記録ステータスは、old_statusへ：new_statusに変更されます。理由::理由',
  ),
  'is_seed_box_yes' => 'このIPはシードボックスで、ID：IDのレコードによって決定されます',
  'is_seed_box_no' => 'このIPはシードボックスではありません',
);
