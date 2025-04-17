<?php

namespace App\Console\Commands;

use App\Models\ExamUser;
use App\Models\PersonalAccessToken;
use App\Models\Torrent;
use App\Models\User;
use App\Repositories\ExamRepository;
use App\Repositories\UploadRepository;
use Illuminate\Console\Command;
use NexusPlugin\Menu\Filament\MenuItemResource\Pages\ManageMenuItems;
use NexusPlugin\Menu\MenuRepository;
use NexusPlugin\Menu\Models\MenuItem;
use NexusPlugin\Permission\Models\Permission;
use NexusPlugin\Permission\Models\Role;
use NexusPlugin\PostLike\PostLikeRepository;
use NexusPlugin\StickyPromotion\Models\StickyPromotion;
use NexusPlugin\StickyPromotion\Models\StickyPromotionParticipator;
use NexusPlugin\Tracker\TrackerRepository;
use NexusPlugin\Work\Models\RoleWork;
use NexusPlugin\Work\WorkRepository;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just for test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $rep = new ExamRepository();
       $result = $rep->getUserExamProgress(10041, ExamUser::STATUS_NORMAL);
       dd($result);
    }

}
