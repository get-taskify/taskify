<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Pc extends Model {

    use HasFactory;

    protected $table = 'pcs';

    protected $fillable = ['brand', 'cpu', 'ram', 'storage', 'architecture', 'bios_key', 'pc_type', 'system_language', 'repair_object_id'];

    protected const systemlanguages = array(

        1 => 'english',
        2 => 'german',
        3 => 'italian'

    );


    protected const pctypes = array(

        1 => 'pc',
        2 => 'notebook'

    );

    public static function getPctypes() {

        return self::pctypes;

    }

    public function getownPctype() {

        return self::pctypes[$this->pc_type];

    }

    public static function getSystemlanguages() {

        return self::systemlanguages;

    }

    public function getSystemlanguage() {

        return self::systemlanguages[$this->system_language];

    }

    public function repair_object() {

        return $this->hasOne(Repair_object::class);

    }

    public static function getPctype($repair_object_id) {

        $pc_type = Pc::where('repair_object_id', $repair_object_id)->pluck('pc_type')->first();

        return isset(self::pctypes[$pc_type]) ? self::pctypes[$pc_type] : null;

    }

    public static function getSystemLanguageWithId($repair_object_id) {

        $system_language = Pc::where('repair_object_id', $repair_object_id)->pluck('system_language')->first();

        return isset(self::systemlanguages[$system_language]) ? self::systemlanguages[$system_language] : null;

    }

    public static function getPCbyRepair_object_id($id) {

        return PC::where('repair_object_id', $id)->first();

    }

}
