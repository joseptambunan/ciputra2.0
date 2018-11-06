<?php

namespace Modules\Inventory\Entities;

use Modules\Department\Entities\Department;
use Modules\Project\Entities\Project;
use Modules\Inventory\Entities\BarangMasukHibah;
use Modules\Project\Entities\ProjectPtUser;
use Modules\Inventory\Entities\Permintaanbarang;
use Modules\Inventory\Entities\Pengembalianbarang;
use Modules\Inventory\Entities\Barangkeluar;
class CreateDocument 
{
    //
    public static function createDocumentNumber($doc_type,$department_id,$project_id,$user_id)
    {
        $roman         = [
            '1' => 'I',
            '2' => 'II',
            '3' => 'III',
            '4' => 'IV',
            '5' => 'V',
            '6' => 'VI',
            '7' => 'VII',
            '8' => 'VIII',
            '9' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];

        $department = Department::find($department_id)->code;
        $bulan      = $roman[date('n')];
        $tahun      = date('Y');
        $project    = Project::find($project_id)->code;    // use \Session::put('project', value) in command prompt

        $pt         = ProjectPtUser::where('user_id',$user_id)->first()->pt->code;
        $doc_last = '/'.$doc_type.'/'.$department.'/'.$bulan.'/'.$tahun.'/'.$project.'/'.$pt;
        $count[0] = BarangMasukHibah::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        $count[1] = Permintaanbarang::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        $count[2] = Barangkeluar::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        $count[3] = Pengembalianbarang::where('no','LIKE','%'.$doc_last)->withTrashed()->count();
        $number = str_pad( (array_sum($count) + 1) ,4,"0",STR_PAD_LEFT);

        return $number.$doc_last;
    }
}
