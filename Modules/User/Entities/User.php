<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Pt\Entities\Pt;
use Modules\User\Entities\UserJabatan;
use Modules\Department\Entities\Department;
use Modules\Division\Entities\Division;
use Modules\Project\Entities\ProjectPtUser;

class User extends Authenticatable
{
     use Notifiable;
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['inactive_at'];

    public function createdBy()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'deleted_by');
    }

    public function inactiveBy()
    {
        return $this->belongsTo('Modules\User\Entities\User', 'inactive_by');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model)
        {
            if ( \Auth::guest() ) 
            {
                $model->created_by = 1;

            }else{
                
                $model->created_by = \Auth::user()->id;
            }
        });

        self::created(function($model){
            //
        });

        self::updating(function($model){
            
            if ( \Auth::guest() ) 
            {
                $model->updated_by = 1;

            }else{
                
                $model->updated_by = \Auth::user()->id;
            }
        });

        self::updated(function($model){
            //
        });

        self::deleting(function($model){
            
            if ( \Auth::guest() ) 
            {
                $model->deleted_by = 1;
                $model->save();

            }else{
                
                $model->deleted_by = \Auth::user()->id;
                $model->save();
            }
        });

        self::deleted(function($model){
            // ... code here
        });
    }

    public function group_detail()
    {
        return $this->hasOne('Modules\User\Entities\UserGroupDetail');
    }

    public function getGroupAttribute()
    {
        if ($this->group_detail == NULL) 
        {
            return \App\UserGroup::find(2);     // restricted user
        }

        return $this->group_detail->group()->first();
    }

    public function project_pt_users()
    {
        return $this->hasMany('Modules\Project\Entities\ProjectPtUser');
    }

    public function details()
    {
        return $this->hasMany('Modules\User\Entities\UserDetail');
    }

    public function approval_histories()
    {
        return $this->hasMany('App\ApprovalHistory');
    }

    public function getApprovalsAttribute()
    {
        return \App\Approval::whereHas('histories', function($q){
            $q->where('user_id', $this->id);
        })->get();
    }

    public function pts()
    {
        return $this->belongsToMany('Modules\Pt\Entities\Pt', 'project_pt_users');
    }

    public function warehouses()
    {
        return $this->belongsToMany('App\Warehouse', 'user_warehouse');
    }

    public function item_categories()
    {
        return $this->belongsToMany('App\ItemCategory', 'item_category_user');
    }

    public function scopeNotRekanan()
    {
        return $this->where('is_rekanan', FALSE);
    }

    public function scopeCanApprove()
    {
        return $this->whereHas('details', function($q){
            $q->where('can_approve', TRUE);
        });
    }

    /*public function jabatan($pt_id)
    {
        $mapping = \App\Mappingperusahaan::where('pt_id', $pt_id)->get(['id']);

        return $this->details()->whereIn('mappingperusahaan_id', $mapping )->first()->jabatan;
    }*/

    public function getDepartmentsAttribute()
    {
        $departments = [];

        foreach ($this->details as $key => $detail) 
        {
            $departments[$key] = $detail->mappingperusahaan->department_id;
        }

        return $departments;
    }

    public function approval_reference(){
        return $this->hasMany("Modules\Approval\Entities\ApprovalReference");
    }

    public function rekanan(){
        return $this->hasOne("Modules\Rekanan\Entities\RekananGroup","user_id");
    }

    public function getJabatanAttribute(){
        $jabatan = Array();
        $jabat_pt = array();
        $tmp = array();
        $jabatan_list = array();
        $detail = $this->details;
        $department = array();
        $division = array();
        $level = array();
        foreach ($detail as $key => $value) {
            $jabatan[$key] = $value->mappingperusahaan->pt_id;
        }

        $pt = array_values(array_unique($jabatan));
        foreach ($pt as $key => $value) {
            foreach ($this->details as $key2 => $value2) {
                if ( $value2->mappingperusahaan->pt_id == $value ){
                    $tmp[$key2] = $value2->user_jabatan_id;
                    $level[$key2] = $value2->user_level;
                    $project[$key2] = $value2->project_pt_id; 
                    $mappingperusahaan[$key2] = $value2->mappingperusahaan_id;
                    if ( $value2->user_level <= 5 ){
                        $department[$key2] = "";
                        $division[$key2] = "";
                    }else  {
                        $department[$key2] = $value2->mappingperusahaan->department_id;
                        $division[$key2]   = $value2->Mappingperusahaan->division_id;
                    }
                }
            }
            $jabat_pt[$key] = array("pt" => $value, "jabatan" => array_values(array_unique($tmp)), "department" => array_values(array_unique($department)), "division" => array_values(array_unique($division)), "level" => array_values(array_unique($level)), "project" => array_values(array_unique($project)) ) ;
        }
        //return $jabat_pt;

        foreach ($jabat_pt as $key => $value) {
           $pt = Pt::find($value['pt']);            
           $jabatan = UserJabatan::find($value['jabatan'][0]);
           
           if ( $value['project'][0] == null ){
                $project_id = "";
           }else{
                $project_pt_users = \Modules\Project\Entities\ProjectPtUser::find($value['project'][0]);
                if ( $project_pt_users != "" ) {
                    $project_id = $project_pt_users->project_pts->project->id;
                }else{
                    $project_id = "";
                }
           }

           if ( $value['level'][0] <= 5 ){
                $department = "";
                $division   = "";
           }else{

                $department = "";
                $division   = "";
                if ( $value['department'][0] != "" ) {
                    $department =  Department::find($value['department'][0])->name;
                }

                if ( $value['division'][0] != ""){
                    $division = Division::find($value['division'][0])->name;
                }
           }


           $jabatan_list[$key] = array ( 
                "pt" => $pt->name, 
                "jabatan" => $jabatan->name, 
                "department" => $department, 
                "division" => $division, 
                "level" => $value['level'][0], 
                "project_id" => $project_id, 
                "pt_id" => $pt->id , 
                "jabatan_id" => $jabatan->id ) ;
        }
        return $jabatan_list;
    }

    public function spks(){
        return $this->hasMany("Modules\Spk\Entities\Spk","pic_id");
    }



}
