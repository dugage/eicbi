<table class="table">

    <thead>
        <tr>
        <th>#</th>
        <th>Bloque</th>
        <th>Creado</th>
        <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($blocks as $block)
            @if($verifityBlock[$block->hash])
            <tr>
            @else
            <tr style="background-color: red;">
            @endif
                <td>{{$block->id}}</td>
                <td>{{$block->data}}</td>
                <td>{{$block->created_at}}</td>
                <td>
                    <a href="#" class="btn btn-gradient-success btn-fw">Ver</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    
</table>