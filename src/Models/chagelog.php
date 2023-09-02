<?php

namespace AlexGh12\ChangeLog\Models;

use Illuminate\Database\Eloquent\Model;

class changelog extends Model
{
	protected $table = '_changelog';
	protected $connection = 'changelogdb';
}
