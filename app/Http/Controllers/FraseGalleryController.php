<?php

namespace App\Http\Controllers;

use App\Http\Requests\FraseGalleryRequest;
use Illuminate\Http\Request;
use App\Models\FraseGallery;

class FraseGalleryController extends Controller
{

    protected $fraseGallery;

    public function __construct(FraseGallery $fraseGallery)
    {
        $this->fraseGallery = $fraseGallery;
    }

    // Visualição das imagens e texto
    public function index()
    {
        $images = $this->fraseGallery->getAll();
        return view('principal_page', compact('images'));
    }

    // Envio das imagens e texto
    public function upload(FraseGalleryRequest $request)
    {
        $data = $request->validated();

        // Envio e salvamento da imagem enviada.
        $input['image'] = time() . '.' . $data['image']->getClientOriginalExtension();
        $data['image']->move(public_path('images'), $input['image']);

        // Envio e salvamento do texto enviado.
        $input['texto'] = $data['texto'];

        // Envio e salvamento do titulo da Imagem/texto
        $input['titulo'] = $data['titulo'];
        $created = $this->fraseGallery->store($input);



        // Mensagem de confirmação do envio e retorno a pagina principal
        return back()
            ->with('success', 'Sua Imagem foi enviada com sucesso!');
    }

    // Remoção das imagens e texto
    public function destroy($id)
    {
        $this->fraseGallery->deleteById($id);

        // Mensagem de confirmação da remoção do item e retorno a pagina principal
        return back()
            ->with('success', 'Sua Imagem foi apagada com sucesso!');
    }
}
