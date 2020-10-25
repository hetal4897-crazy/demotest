<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post  extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id';

    public function metadata(){
    	return $this->hasmany("App\Models\Postmeta","post_id","id");
    }
}
?>