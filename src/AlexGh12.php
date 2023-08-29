<?php

namespace AlexGh12;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void component($alias, $viewClass)
 * @method static \Livewire\Testing\TestableLivewire test($name, $params = [])
 * @method static \Livewire\LivewireManager actingAs($user, $driver = null)
 * @method static \Livewire\LivewireManager withQueryParams($queryParams)
 *
 * @see \Livewire\LivewireManager
 */
class ChangeLog extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'ChangeLog';
    }
}
