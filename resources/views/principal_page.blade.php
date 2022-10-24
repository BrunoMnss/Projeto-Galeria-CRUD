<!DOCTYPE html>
<html>

<head>
    <title>Galeria de Imagens - CRUD</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- References: https://github.com/fancyapps/fancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />

    <!-- Styles -->
    <style type="text/css">
        .gallery {
            display: inline-block;
            margin-top: 20px;
        }

        .close-icon {
            border-radius: 50%;
            position: absolute;
            right: 0px;
            top: 0px;
            padding: 5px 8px;
        }

        .form-image-upload {
            background: #e8e8e8 none repeat scroll 0 0;
            padding: 15px;
            margin-bottom: 20px;
        }

        .fancybox__caption {
    font-size: 20px;
    text-align: center;
     max-width: 80%;}


    </style>

</head>

<body>

    <div class="container">
        <div align="center">
            <h3><b>Galeria de Imagens - <u>CRUD</u></b></h3>
        </div>

        <form action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-image-upload">


                <!-- Aviso de erro no envio da frase/imagem -->
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Ops...</strong> Houve algum erro com o seu envio!<br />
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Aviso de erro no envio da frase/imagem -->

                <!-- Botão para fechar a imagem aberta para visualização -->
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <!-- Botão para fechar a imagem aberta para visualização -->

                <!-- Preenchimento dos campos (Titulo, Descrição e Imagem) com botão para envio(upload) dos mesmos -->

                <div class="row">

                    <!-- Campo Titulo -->
                    <div class="col-md-2">
                        <strong>Titulo:</strong>
                        <input type="text" name='titulo' class="form-control" placeholder="Titulo">
                    </div>
                    <!-- Campo Titulo -->

                    <!-- Campo Descrição -->
                    <div class="col-md-4">
                        <strong>Descrição:</strong>
                        <input type="text" name="texto" class="form-control" placeholder="Descrição">
                    </div>
                    <!-- Campo Descrição -->

                    <!-- Campo de anexo da imagem -->
                    <div class="col-md-4">
                        <strong>Imagem:</strong>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <!-- Campo de anexo da imagem -->

                    <!-- Botão para envio da frase/imagem -->
                    <div class="col-md-2">
                        <br />
                        <button type="submit" class="btn-success btn"><b>Enviar</b></button>
                    </div>
                    <!-- Botão para envio da frase/imagem -->
                </div>
                <!-- Preenchimento dos campos (Titulo, Descrição e Imagem) com botão para envio(upload) dos mesmos -->
            </div>
        </form>

        <div class="row">
            <div class='list-group '>

                
                @foreach($images as $image)
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                    

                    <a data-caption="Descrição: {{ $image->texto }}" data-fancybox="gallery" href="{{ asset('images/'.$image->image) }}">
                        <img class="rounded" 

                        style="width: 265px; height:265px; 
                        box-sizing: content-box; 
                        background: #fff;
                        margin-top: 20px;
                        margin-right: 20px;
                        border-radius: 10px; 
                        color: #374151;
                        box-shadow: 0 8px 23px rgb(0 0 0 / 50%);
                        " 
                         src="{{ asset('images/'.$image->image) }}" /><br>

                         <div class='text-center' style="margin-top: 5px; font-size:18px;">
                            <small class='text-muted'><b>{{ $image->titulo }}</b></small>
                        </div>
                    </a><br>

                    <form action="{{ route('gallery.delete', $image->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                    </form>
                </div>
                @endforeach


            </div>
        </div>
    </div>

</body>

<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "fade",
            closeEffect: "fade",
        });
    });
</script>

</html>