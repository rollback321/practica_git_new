<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_pri_usuarios extends Model
{
    /** @use HasFactory<\Database\Factories\TblPriUsuariosFactory> */
    use HasFactory;

    protected $table = 'principal.tbl_pri_usuarios';
   // protected $schema = 'nombre_del_esquema';
    protected $primaryKey = 'us_id';
    protected $fillable = [
        'us_id',
        'us_nombres',
        'us_password', 
        'us_nom_usuario',
        'us_paterno',
        'us_materno',
        'us_estado'
    ];

    public function scopeFiltrarPorCampo($query, $id){
        return $query->where("us_id",$id);
    }  
    
    public function scopeByFiltrarPorCampoEstado($query, $estado){
        if(!is_null($estado) && trim($estado) != ""){
            return $query->where("us_estado",$estado);
        }
    } 
    
    public function scopeByFiltrarForSearch($query, $dato){       
        if ($dato) {
            /**Se convierte a mayusculas y se quita los espacios */
            // $dato = mb_strtoupper(trim($dato));
            /**Se convierte a minicula y se quita los espacios */
            //$dato = mb_strtolower(trim($dato)); 
            /**Se genera multipples condiciones en WHERE */
            return $query->where(function ($q) use ($dato) {
                    $q->where('us_nombres','LIKE',"%{$dato}%")
                    ->orWhere('us_nom_usuario','LIKE',"%{$dato}%")
                    ->orWhere('us_paterno','LIKE',"%{$dato}%")
                    ->orWhere('us_materno','LIKE',"%{$dato}%");
            });
        }
    }

    public function scopeByFilterForDate ($query, $start, $end){ 
        if ($start && $end){   
            $query->whereBetween('us_f_creacion',[$start, $end]);
        }
    }
}
