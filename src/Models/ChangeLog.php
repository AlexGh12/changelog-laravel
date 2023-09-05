<?php

namespace AlexGh12\ChangeLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ChangeLog extends Model
{
	use SoftDeletes;

	protected $table = 'changelog';
	protected $connection = 'changelogdb';
	protected $fillable = [	'version','title','description','content'];

	public function fetchAll()
    {
        return $this->all();
    }

    public static function fetchById($id)
    {
        return self::findOrFail($id);
    }

	public static function storeNew($data) {

		$data['description'] = $data['editor_content'];
    	return self::create($data);
	}


    public function modify($data)
    {
        $this->version     = $data['version'];
        $this->title       = $data['title'];
        $this->description = $data['description'];
		$this->save();
    }

    public function remove()
    {
        return $this->delete();
    }


}
