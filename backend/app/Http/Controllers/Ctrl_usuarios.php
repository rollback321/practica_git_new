<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_pri_usuarios;
use Exception;
use PDOException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\UniqueConstraintViolationException;
use App\Http\Resources\ResourceUsuarios;
use App\Http\Requests\UsuarioRequest;
use App\Http\Responses\ApiResponse;

class Ctrl_usuarios extends Controller
{
    
    /** ==========  Listar registros http GET (http GET -> URL}) ========== */
    public function index (Request $request) {
        
        try{
            /** Se obtiene lis registro y se realiza el filtrado segun el campo */
            $query = tbl_pri_usuarios::query();          
            $query->ByFiltrarPorCampoEstado($request->input('status'));
            $query->ByFiltrarForSearch($request->input('search'));
            $query->ByFilterForDate($request->input('start_date'),$request->input('end_date'));

            /** Metodo cuando se verifica que el metodo filled verifica que sea distinto de "false,'',[],null" -> varifica si tiene algun dato */
            if ($request->input("sort_by.status")) {
                $query->orderBy($request->input("sort_by.column", "us_id"), $request->input("sort_by.order_by", "desc"));             
            } else {
                $query->orderBy("us_id","desc");
            }
            return ApiResponse::success("ok", 200, ResourceUsuarios::collection($query->get()));      
        } catch (Exception $e) {
            return ApiResponse::error("error", 500, $e->getMessage());
        }                    
    }

    /**  =========  Permite mostrar registro, mediante la clave unica del registro (http GET -> URL../{$id})  ======*/
    public function show (Request $request, $id) {
        try{        
            $data_user = tbl_pri_usuarios::find($id);            
            /** Se identica si existe datos del registro */
            if (!empty($data_user)){
                $data_return = ResourceUsuarios::make($data_user);
                return ApiResponse::success("ok", 200, $data_return );
            } else {
                return ApiResponse::error("not data", 500, "No se presentan datos");               
            }
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Model Elocuent", 500, $e->getMessage());            
        } catch (Exception $e) {
            return ApiResponse::error("Exception Inesperado", 500, $e->getMessage());           
        }
        
    }

    /** =====================  Permite crear un registro de usuario (http POST) ============= */
    public function store (UsuarioRequest $request){
       $validatedData = $request->validated();

       $usuario = tbl_pri_usuarios::create($validatedData);
        try{
            if ($usuario){
                    return ApiResponse::success("ok",201, $usuario);                            
            } else {
                    return $usuario;
                    //ApiResponse::error("error",500,"Error creating user");
            }
        } catch (Exception $e){
            return ApiResponse::error("error",500,$e->getMessage());        
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("Model Elocuent", 500, $e->getMessage());            
        }
        catch (UniqueConstraintViolationException $e) {          
            $errorMessage = "La contraseña ya existe. Por favor, elige otra."; 
            return ApiResponse::error("Model Elocuent", 500, $errorMessage);         
        } 
    }

    /** ===================== Permte Actualizar actualizar registros (http PUT, PATH --> URL../{$id}) ======== */
    /** ===================== PUT -> actualizar registro con varios datos, PATCH -> actualizar el estado del registro =======*/
    public function update (UsuarioRequest $request, $id){
        try {
            /** Se verifica que el registro sea numerico*/
            if (!is_numeric($id)){
                return ApiResponse::error("error",500,"The data is not numeric");
            } else {
                /** Se verifica que existe el registro*/
                $data_user = tbl_pri_usuarios::find($id); 
                if($data_user){
                    /** http PATCH */
                    if($request->isMethod('patch')){
                        $data_user->update(['us_estado' => $request->input('status')]);
                        return  ApiResponse::success("State update success", 200, $data_user);    
                    /** http PUT*/             
                    } else {   
                        $data_user->update($request->validated());                     
                        return ApiResponse::success("Success", 200, "ok");
                    }                    
                } else {
                    return ApiResponse::error("error",500,"data not register");                
                }
            }  
        } catch (Exception $e) {
            return ApiResponse::error('An unexpected error ocurred', 500, $e->getMessage()); 
        }                                   
    }

    public function pruebaMid (Request $request) {
        return $request;
    }  

}
