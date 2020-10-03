<?php

namespace App\Console\Commands;

use App\Breakfast;
use App\Menu;
use App\User;
use App\UserMenu;
use Illuminate\Console\Command;

class OrderBreakfast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:breakfast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Order Breakfast';

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
        $tomorrow = now()->addDay();
        // TODO :: remove true
        if (in_array($tomorrow, WEEKDAYS) || true) {
            $ordered = $cancelled = [];
            $totalUsersCount = $orderedCount = 0;
            $menu = Menu::getTomorrowMenu($tomorrow->format('l'));
            $breakfast = Breakfast::whereDate('date', $tomorrow->format('y-m-d'))->first();
            if (!$breakfast) {
                list($ordered, $totalUsersCount, $orderedCount, $totalAmount) = $this->getUserBasedDetails($menu, $ordered, $totalUsersCount, $orderedCount);
                $input = [
                    'menu_id' => $menu->id,
                    'status' => STATUS_COMPLETED,
                    'bill_type' => $menu->bill_type,
                    'date' => $tomorrow->format('y-m-d'),
                    'user_count' => $totalUsersCount,
                    'ordered_count' => $orderedCount,
                    'total_amount' => $totalAmount,
                    'ordered' => $ordered,
                    'cancelled' => $cancelled,
                ];
                if ($orderedCount !== 0) {
                    Breakfast::create($input);
                }
            } else {
                $cancelledUserIds = array_keys($breakfast->cancelled);
                list($ordered, $totalUsersCount, $orderedCount, $totalAmount) = $this->getUserBasedDetails($menu, $ordered, $totalUsersCount, $orderedCount, $cancelledUserIds);
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

    function getUserBasedDetails($menu, $ordered, $totalUsersCount, $orderedCount, $excludedUserIds = []) {
        $users = User::where('breakfast', true)->whereNotIn('id', $excludedUserIds)->get();
        foreach ($users as $user) {
            $userMenu = UserMenu::where('user_id', $user->id)->where('menu_id', $menu->id)->first();
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
