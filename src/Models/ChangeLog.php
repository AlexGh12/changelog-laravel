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

	public static function fetchAll()
    {
        return self::all();
    }

    public static function fetchById($id)
    {
        return self::findOrFail($id);
    }

	public static function storeNew($data) {

		$data['content'] = $data['editor_content'];

    	return self::create($data);
	}


    public function modify($data)
    {
        $this->version     = $data['version'];
        $this->title       = $data['title'];
        $this->description = $data['description'];
        $this->content     = $data['editor_content'];
		$this->save();
    }

    public static function remove(string $id): bool
    {
        $data = self::findOrFail($id);
        return $data->delete();
    }


}
