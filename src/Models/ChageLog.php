<?php

namespace AlexGh12\ChangeLog\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{
	protected $table = 'changelog';
	protected $connection = 'changelogdb';
}
