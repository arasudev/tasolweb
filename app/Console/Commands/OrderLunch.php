<?php

namespace App\Console\Commands;

use App\Lunch;
use App\Menu;
use App\User;
use App\UserMenu;
use Illuminate\Console\Command;

class OrderLunch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:lunch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Order Lunch';

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
     * @return mixed
     */
    public function handle()
    {
        $today = now();
        // TODO :: remove true
        if (in_array($today, WEEKDAYS) || true) {
            $ordered = $cancelled = [];
            $totalUsersCount = $orderedCount = 0;
            list($menuOne, $menuTwo) = Menu::getTodayLunchMenus(now()->format('l'));
            $lunch = Lunch::whereDate('date', $today->format('y-m-d'))->first();
            if (!$lunch) {
                list($ordered, $totalUsersCount, $orderedCount, $totalAmount) = $this->getUserBasedDetails($menuOne, $menuTwo);
                $input = [
                    'menu_id_one' => $menuOne->id,
                    'menu_id_two' => $menuTwo->id,
                    'status' => STATUS_COMPLETED,
                    'bill_type' => $menuTwo ? BILL_TYPE_INDIVIDUAL : BILL_TYPE_COMMON,
                    'date' => now()->format('y-m-d'),
                    'user_count' => $totalUsersCount,
                    'ordered_count' => $orderedCount,
                    'total_amount' => $totalAmount,
                    'ordered' => $ordered,
                    'cancelled' => $cancelled,
                ];
                if ($orderedCount !== 0) {
                    Lunch::create($input);
                }
            } else {
                $cancelledUserIds = array_keys($breakfast->cancelled);
                list($ordered, $totalUsersCount, $orderedCount, $totalAmount) = $this->getUserBasedDetails($cancelledUserIds);
                $breakfast->update([
                    'menu_id' => $menu->id,
                    'status' => STATUS_COMPLETED,
                    'bill_type' => $menu->bill_type,
                    'users_count' => $totalUsersCount,
                    'ordered_count' => $orderedCount,
                    'total_amount' => $totalAmount,
                    'ordered' => $ordered,
                ]);
            }
        }
    }

    function getUserBasedDetails($menuOne, $menuTwo, $excludedUserIds = []) {
        $users = User::where('lunch', true)->whereNotIn('id', $excludedUserIds)->get();
        foreach ($users as $user) {
            $userMenu = UserMenu::where('user_id', $user->id)->whereIn('menu_id', [$menuOne, $menuTwo])->get();
            if ($userMenu->count) {
                $ordered[$user->id] = [
                    'count' => $userMenu->count,
                    'price' => ($menu->bill_type === BILL_TYPE_INDIVIDUAL ? ($userMenu->count * $menu->price) : null),
                ];
                $totalUsersCount += 1;
                $orderedCount += $userMenu->count;
            }
        }
        $totalAmount = $orderedCount * $menu->price;
        if ($menu->bill_type === BILL_TYPE_COMMON) {
            // TODO :: change the logic
            $orderedCount = $totalUsersCount;
            $totalAmount = ($orderedCount * $menu->price) + BREAKFAST_UPMA_CURD_PRICE;
        }

        return[$ordered, $totalUsersCount, $orderedCount, $totalAmount];
    }
}
