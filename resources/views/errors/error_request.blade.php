@if($errors->any())
    <div class="alert alert-warning">
        <button class="close" data-dismiss="alert">&times;</button>
        <h4>Aviso</h4>

        <strong>Solucione los siguientes errores</strong>:
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif