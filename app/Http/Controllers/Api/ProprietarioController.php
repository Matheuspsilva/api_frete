<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProprietarioRequest;
use App\Models\Proprietario;
use Illuminate\Http\Request;

class ProprietarioController extends Controller
{
    private $proprietario;

    public function __construct(Proprietario $proprietario)
    {
        $this->proprietario = $proprietario;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proprietarios = $this->proprietario->paginate('10');

        return response()->json($proprietarios, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProprietarioRequest $request)
    {
        $data = $request->all();

        try {

            $proprietario= $this->proprietario->create($data);

            return response()->json(['data' => [
                'msg' => 'O Proprietario foi cadastrado com sucesso '
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $proprietario = $this->proprietario->findOrFail($id);

            return response()->json([
                'data' => $proprietario
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        try {

            $proprietario = $this->proprietario->findOrFail($id);
            $proprietario->update($data);

            return response()->json(['data' => [
                'msg' => 'O Proprietário foi atualizado com sucesso '
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $proprietario = $this->proprietario->findOrFail($id);
            $proprietario->delete();

            return response()->json(['data' => [
                'msg' => 'O Proprietário foi removido com sucesso ']
            ]
            , 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
        }
    }
}
