<?php

namespace App\Http\Controllers;

use App\Helpers\formatAPI;
use App\Models\Penduduk;
use Exception;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
      $data = Penduduk::all();

      if($data){
          return formatAPI::createAPI(200, 'Success' ,$data);
      }else{
          return formatAPI::createAPI(400, 'Failed');
      }
    }

    public function store(Request $request)
    {
        try{
            //untuk create data ke database
           $penduduk = Penduduk::create($request->all());

            //get data penduduk where id_penduduk = id_penduduk
            $data = Penduduk::where('id_penduduk','=',$penduduk->id_penduduk)->get();

            //check data is valid? return data : failed
            if($data){
                return formatAPI::createAPI(200, 'Success' ,$data);
            }else{
                return formatAPI::createAPI(400, 'Failed');

            }
        }catch(Exception $error){
            return formatAPI::createAPI(400, 'Failed',$error);
        }
    }

    public function show($id_penduduk)
    {
        try{
            $data = Penduduk::where('id_penduduk','=',$id_penduduk)->first();
            if($data){
                return formatAPI::createAPI(200, 'Success' ,$data);
            }else{
                return formatAPI::createAPI(400, 'Failed');

            }  

        }catch(Exception $error){
            return formatAPI::createAPI(400, 'Failed',$error);
        }
    }

    public function update(Request $request, $id_penduduk)
    {
        try{
            $penduduk = Penduduk::findorfail($id_penduduk);
            $penduduk->update($request->all());

            $data = Penduduk::where('id_penduduk','=',$penduduk->id_penduduk)->get();
            if($data){
                return formatAPI::createAPI(200, 'Success' ,$data);
            }else{
                return formatAPI::createAPI(400, 'Failed');

            }  
        
        }catch(Exception $error){
            return formatAPI::createAPI(400, 'Failed',$error);
        }
    }

    public function destroy($id_penduduk)
    {
        try{
            $penduduk = Penduduk::findorfail($id_penduduk);

            $data = $penduduk->delete();
            if($data){
                return formatAPI::createAPI(200, 'Success' ,$data);
            }else{
                return formatAPI::createAPI(400, 'Failed');

            }  
            
        }catch (Exception $error) {
            return formatAPI::createAPI(400, 'Failed',$error);
        }
    }

}
