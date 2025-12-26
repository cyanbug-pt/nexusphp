<?php
namespace App\Repositories;

use App\Exceptions\NexusException;
use App\Models\Medal;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserMedal;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Nexus\Database\NexusDB;

class MedalRepository extends BaseRepository
{
    public function getList(array $params): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Medal::query();
        list($sortField, $sortType) = $this->getSortFieldAndType($params);
        $query->orderBy($sortField, $sortType);
        return $query->paginate();
    }

    public function store(array $params)
    {
        return Medal::query()->create($params);
    }

    public function update(array $params, $id)
    {
        $medal = Medal::query()->findOrFail($id);
        $medal->update($params);
        return $medal;
    }


    public function getDetail($id)
    {
        return Medal::query()->findOrFail($id);
    }

    /**
     * delete a medal, also will delete all user medal.
     *
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $medal = Medal::query()->findOrFail($id);
        NexusDB::transaction(function () use ($medal) {
            do {
                $deleted = UserMedal::query()->where('medal_id', $medal->id)->limit(10000)->delete();
            } while ($deleted > 0);
            $medal->delete();
        });
        return true;
    }

    public function  grantToUser(int $uid, int $medalId, $duration = null)
    {
        $user = User::query()->findOrFail($uid, User::$commonFields);
        if (Auth::user()->class <= $user->class) {
            throw new \LogicException("No permission!");
        }
        $medal = Medal::query()->findOrFail($medalId);
        $exists = $user->valid_medals()->where('medal_id', $medalId)->exists();
        do_log(last_query());
        if ($exists) {
            throw new \LogicException("user: $uid already own this medal: $medalId.");
        }
        $this->userAttachMedal($user, $medal);
    }

    public function userAttachMedal(User $user, Medal $medal): void
    {
        $expireAt = null;
        $bonusAdditionExpireAt = null;
        if ($medal->duration > 0) {
            $expireAt = Carbon::now()->addDays((int)$medal->duration)->toDateTimeString();
        }
        if ($medal->bonus_addition_duration > 0) {
            $bonusAdditionExpireAt = Carbon::now()->addDays((int)$medal->bonus_addition_duration)->toDateTimeString();
        }
        $user->medals()->attach([
            $medal->id => [
                'expire_at' => $expireAt,
                'bonus_addition_expire_at' => $bonusAdditionExpireAt,
                'status' => UserMedal::STATUS_NOT_WEARING,
            ]
        ]);
        clear_user_cache($user->id);
    }

    public function toggleUserMedalStatus($id, $userId)
    {
        $userMedal = UserMedal::query()->findOrFail($id);
        if ($userMedal->uid != $userId) {
            throw new \LogicException("no privilege");
        }
        $current = $userMedal->status;
        if ($current == UserMedal::STATUS_NOT_WEARING) {
            $maxWearAllow = Setting::get('system.maximum_number_of_medals_can_be_worn');
            $user = User::query()->findOrFail($userId, User::$commonFields);
            $wearCount = $user->wearing_medals()->count();
            if ($maxWearAllow && $wearCount >= $maxWearAllow) {
                throw new NexusException(nexus_trans('medal.max_allow_wearing', ['count' => $maxWearAllow]));
            }
            $userMedal->status = UserMedal::STATUS_WEARING;
        } elseif ($current == UserMedal::STATUS_WEARING) {
            $userMedal->status = UserMedal::STATUS_NOT_WEARING;
        }
        $userMedal->save();
        clear_user_cache($userId);
        return $userMedal;
    }

    public function saveUserMedal(int $userId, array $userMedalData)
    {
        $user = User::query()->findOrFail($userId);
        $validMedals = $user->valid_medals;
        if ($validMedals->isEmpty()) {
            return true;
        }
        $statusCaseWhens = $priorityCaseWhens = $idArr = [];
        $wearCount = 0;
        foreach ($validMedals as $medal) {
            $id = $medal->pivot->id;
            $idArr[] = $id;
            if (isset($userMedalData[$id]['status'])) {
                $status = UserMedal::STATUS_WEARING;
                $wearCount++;
            } else {
                $status = UserMedal::STATUS_NOT_WEARING;
            }
            $statusCaseWhens[] = sprintf('when `id` = %s then %s', $id, $status);
            $priorityCaseWhens[] = sprintf('when `id` = %s then %s', $id, $userMedalData[$id]['priority'] ?? 0);
        }
        $maxWearAllow = Setting::get('system.maximum_number_of_medals_can_be_worn');
        if ($maxWearAllow && $wearCount > $maxWearAllow) {
            throw new NexusException(nexus_trans('medal.max_allow_wearing', ['count' => $maxWearAllow]));
        }
        $sql = sprintf(
            'update user_medals set `status` = case %s end, `priority` = case %s end where id in (%s)',
            implode(' ', $statusCaseWhens), implode(' ', $priorityCaseWhens), implode(',', $idArr)
        );
        do_log("sql: $sql");
        clear_user_cache($userId);
        return NexusDB::statement($sql);
    }

    public function increaseExpireAt(Collection $collection, string $field, int $duration): void
    {
        $this->checkExpireField($field);
        $idArr = $collection->pluck('id')->toArray();
        $result = NexusDB::table("user_medals")
            ->whereIn('id', $idArr)
            ->whereNotNull($field)
            ->update([$field => NexusDB::raw("`$field` + INTERVAL $duration DAY")]);
        do_log(sprintf(
            "operator: %s, increase records: %s $field + $duration day, result: %s",
            get_pure_username(), implode(', ', $idArr), $result
        ));
    }

    public function updateExpireAt(Collection $collection, string $field, Carbon $expireAt): void
    {
        $this->checkExpireField($field);
        $idArr = $collection->pluck('id')->toArray();
        $result = NexusDB::table("user_medals")
            ->whereIn('id', $idArr)
            ->update([$field => $expireAt]);
        do_log(sprintf(
            "operator: %s, update records: %s $field $expireAt, result: %s",
            get_pure_username(), implode(', ', $idArr), $result
        ));
    }

    public function cancelExpireAt(Collection $collection, string $field): void
    {
        $this->checkExpireField($field);
        $idArr = $collection->pluck('id')->toArray();
        $result = NexusDB::table("user_medals")
            ->whereIn('id', $idArr)
            ->update([$field => NexusDB::raw("null")]);
        do_log(sprintf(
            "operator: %s, update records: %s $field null, result: %s",
            get_pure_username(), implode(', ', $idArr), $result
        ));
    }

    private function checkExpireField(string $field): void
    {
        if (!in_array($field, ['expire_at', 'bonus_addition_expire_at'])) {
            throw new \InvalidArgumentException("invalid field: $field");
        }
    }

}
