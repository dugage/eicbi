@extends('courses::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">{{ trans('app.courses.courses') }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.courses.myCourses') }}</li>
    
@stop

@section('main-content')
    
    <div class="page-header">

        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-school"></i>                 
            </span>
            Curso Bitcoin
        </h3>

    </div>

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#"  data-toggle="modal" data-target="#modulo1">Módulo 1</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        Origen del dinero
                    </p>

                </div>

            </div>

        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#modulo2">Módulo 2</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        Blockchain
                    </p>

                </div>

            </div>

        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#modulo3">Módulo 3</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        Minería
                    </p>

                </div>

            </div>

        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#modulo4">Módulo 4</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        Cómo obtener BTC
                    </p>

                </div>

            </div>

        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#modulo5">Módulo 5</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        ICO´s
                    </p>

                </div>

            </div>

        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#modulo6">Módulo 6</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        Trading Criptomonedas
                    </p>

                </div>

            </div>
    
        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#modulo7">Módulo 7</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        Legalidad
                    </p>

                </div>

            </div>
    
        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#modulo8">Módulo 8</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        Seguridad de las Criptomonedas
                    </p>

                </div>

            </div>

        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#modulo9">Módulo 9</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        Planificación Financiera
                    </p>

                </div>

            </div>

        </div>
        
    </div>

<!-- The Modal -->
<div class="modal" id="modulo1">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 1 | Origen del dinero</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/96WXVamj9X8?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_1_OrigenDinero.pdf" target="_blank" class="alert-link">OrigenDinero.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modulo2">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 2 | Blockchain</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/RN5kOMO1Z1E?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_2_Blockchain.pdf" target="_blank" class="alert-link">Blockchain.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modulo3">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 3 | Minería</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/96WXVamj9X8?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_3_ MINERIA.pdf" target="_blank" class="alert-link">Minería.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modulo4">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 4 | Cómo obtener BTC</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/7BlSz1E06CQ?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_4. Como_obtener_BTC.pdf" target="_blank" class="alert-link">obtenerBTC.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modulo5">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 5 | ICOs</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/ybCxmL--WnY?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_5_ICO.pdf" target="_blank" class="alert-link">ICOs.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modulo6">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 6 | Trading Criptomonedas</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/96WXVamj9X8?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_6_TRADING.pdf" target="_blank" class="alert-link">TRADING.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modulo7">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 7 | Legalidad</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/Ul-HvK3Mbz8?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_7_Legalidad.pdf" target="_blank" class="alert-link">Legalidad.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modulo8">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 8 | Seguridad de las Criptomonedas</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/FdyXih0LVEU?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_8_SEGURIDAD.pdf" target="_blank" class="alert-link">SEGURIDAD.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="modulo9">
  <div style="max-width: 700px;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Módulo 9 | Planificación Financiera</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/lHmuXmmc8UI?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div style="border: 1px solid #727272;" class="alert alert-secondary">
            {{ trans('app.courses.chapterAttachedFile') }}<br/>
            <a href="http://www.pruebasdugage.es/eicbi_pdf/CursoCriptomonedasPDF/MODULO_9.pdf" target="_blank" class="alert-link">PlanificacionFinanciera.pdf</a>
        </div>

    </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
@stop
