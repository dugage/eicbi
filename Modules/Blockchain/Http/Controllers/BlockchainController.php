<?php

namespace Modules\Blockchain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Blockchain\BlockChain;
use App\Blockchain\Block;
use App\Models\BlockChainModel;

class BlockchainController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //obtenmos los chain, que son index = 0
        $chains = BlockChainModel::where('index',0)->get();
        //dump($chains);
        return view('blockchain::index',compact('chains'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('blockchain::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //comprobamos si comenzamos una nueva cadena de bloques o no
        if( $request->newChain == 1 ){
            //obtenemos el bloque genesis
            $block = new BlockChain();
            //creamos un nuevo bloque
            $newBlock = new BlockChainModel;
            $newBlock->index = $block->chain[0]->index;
            $newBlock->nonce = $block->chain[0]->nonce;
            $newBlock->timestamp = $block->chain[0]->timestamp;
            $newBlock->data = $block->chain[0]->data;
            $newBlock->previous_hash = $block->chain[0]->previousHash;
            $newBlock->hash = $block->chain[0]->hash;
            //guardamos en la base de datos
            $newBlock->save();


        }else{
            //obtenemos el úñtimo bloque
            $lastBlock = BlockChainModel::orderBy('created_at', 'desc')->first();
            //dump($lastBlock);
            $block = new Block($lastBlock->index + 1, strtotime("now"), $request->data,$lastBlock->hash);
            //dump($block->index);
            //creamos un nuevo bloque
            $newBlock = new BlockChainModel;
            $newBlock->index = $block->index;
            $newBlock->nonce = $block->nonce;
            $newBlock->timestamp = $block->timestamp;
            $newBlock->data = $block->data;
            $newBlock->previous_hash = $block->previousHash;
            $newBlock->hash = $block->hash;
            //guardamos en la base de datos
            $newBlock->save();
        }

        //dump($block->chain[0]->index);
        //echo $request->newChain;
        //echo $request->data;
        return redirect('blockchain/create');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('blockchain::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('blockchain::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
