@extends('adminlte::page')

@section('title', 'Teste WebDev - Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Visualisar</h3>
    </div>
    
    <!-- /.box-header -->

    <div class="box-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                {{$message}}
            </div>
        @endif

        <div class="tDiv row">
            <div class="tDiv2 col-xs-6">
                <a
                    href="{{ route('clients.create') }}"
                    title='Inserir Cliente'
                    class='add-anchor add_button btn btn-primary btn-flat'>
                    <i class="fa fa-plus-circle"></i>
                    <span class="add">Adicionar Cliente</span>
                </a>
            </div>
        </div><br>

        
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->cpf }}</td>
                        <td>{{ $client->email }}</td>
                        <td width="130px;">
                            <a
                                href="{{ route('clients.show', $client->id) }}"
                                title='Visualizar'
                                class='add-anchor add_button btn btn-info btn-flat'>
                                <i class="fa fa-eye"></i>
                            </a>
                            <a
                                href="{{ route('clients.edit', $client->id) }}"
                                title='Editar'
                                class='add-anchor add_button btn btn-primary btn-flat'>
                                <i class="fa fa-edit"></i>
                            </a>
                            <a
                                href="#delete"
                                title='Excluir'
                                data-campid="{{ $client->id }}"
                                class='add-anchor add_button btn btn-danger btn-flat'
                                data-toggle="modal"
                                data-target="#delete">
                                <i class="fa fa-trash"></i>
                            </a>                        
                       </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Opções</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal modal-danger fade delete" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Confirmar exclusão</h4>
            </div>
            <form action="{{route('clients.destroy', 'client')}}" method="post">
      		    {{method_field('delete')}}
      		    {{csrf_field()}}
	            <div class="modal-body">
				    <p class="text-center">
					    Tem certeza que deseja excluir este item?
				    </p>
	      		    <input type="hidden" name="client_id" id="cli_id" value="">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-success" data-dismiss="modal">Não, cancelar</button>
	                <button type="submit" class="btn btn-warning">Sim, excluir</button>
	            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@stop

@section('js')
<script>
    $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            }
        );
    });
</script>

<script>
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var cli_id = button.data('campid') 
        var modal = $(this)
        modal.find('.modal-body #cli_id').val(cli_id);
    })
</script>
@stop
