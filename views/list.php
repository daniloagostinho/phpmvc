<!DOCTYPE html>
<html>
    <head>
        <title>Teste PHP - Home Page</title>
       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
        require_once '../config/properties.php';        
        require_once 'header.php'; 
        require_once '../controller/AtividadeController.php'; 
        
        $teste = new AtividadeController(); 
        $dados =  $teste->listToView();
       
        ?>
    </head>
    <body>
   <body>

<div class="container">

	<div class="row">
        
        <div class="col-md-12">
        
        <legend class="titulo">Lista de Atividades</legend>
        
        <div class="table-responsive">
        <input type="submit" class="btn btn-success criarnovo" value="&nbsp;Criar Novo&nbsp;" name="criar">
        	<div class="pull-right">
				<div class="btn-group">
					<button type="button" class="btn btn-warning btn-filter" data-target="Pendente">Pendente</button>
					<button type="button" class="btn btn-info btn-filter" data-target="Em desenvolvimento">Em Desenvolvimento</button>
					<button type="button" class="btn btn-danger btn-filter" data-target="Em teste">Em teste</button>
					<button type="button" class="btn btn-success  btn-filter" data-target="Concluído">Concluído</button>
					<button type="button" class="btn btn-default btn-filter" data-target="todos">Todos</button>
				</div>
			</div>
            <table id="tblAtividades" class="table table-bordred table-striped">                   
               <thead>           
               	<th><input type="checkbox" id="checkall" /></th>
               	<th>ID</th>
                <th>Nome</th>
                <th style="width:35%">Descrição</th>
                <th>Data inicial</th>
                <th>Data final</th>
                <th>Situação</th>
                <th>Status</th>
                <th>Ver</th>
                <th>Edit</th>
                <th>Del</th>
               </thead>
               
               <tbody>
               <?php 
               if (is_array($dados) || is_object($dados)):               
               foreach ($dados as $key => $dadoAtividade) :?>
               <?php $checkStatus= ($dadoAtividade['status'] == 'Concluído')?true:false;?>                        
                <tr <?php if($checkStatus): ?> style="background-color:#caf7cf;" <?php endif ?>
                data-status="<?php echo $dadoAtividade['status']; ?>">                
                <td><input type="checkbox" class="checkthis" /></td> 
                <td><?php echo $dadoAtividade['ID'];?></td>
                <td><?php echo $dadoAtividade['nome']; ?></td>
                <td><?php echo $dadoAtividade['descricao']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($dadoAtividade['data_inicio'])); ?></td>
                <td><?php echo date("d-m-Y", strtotime($dadoAtividade['data_fim']));?></td>
                <td><?php
                if($dadoAtividade['situacao']=='1'){
                        echo 'Ativo';
                    }else{
                        echo 'Inativo';
                    }
                 ?></td>
                <td><?php echo $dadoAtividade['status']; ?></td>
                <td><p data-placement="top" data-toggle="tooltip" title="Ver"><button <?php if($checkStatus): ?> disabled <?php endif; ?> class="btn btn-primary btn-xs" onclick="window.location='detail.php?action=view&id=<?php echo $dadoAtividade['ID'];?>'" data-title="Ver"><span <?php if($checkStatus): ?> class="glyphicon glyphicon-eye-close" <?php else: ?> class="glyphicon glyphicon-eye-open" <?php endif; ?>></span></button></p></td>
                <td><p data-placement="top" data-toggle="tooltip" title="Editar"><button <?php if($checkStatus): ?> disabled <?php endif; ?> class="btn btn-primary btn-xs" onclick="window.location='detail.php?action=edit&id=<?php echo $dadoAtividade['ID'];?>'" data-title="Editar"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                <td><p data-placement="top" data-toggle="tooltip" title="Deletar"><button <?php if($checkStatus): ?> disabled <?php endif; ?> class="btn btn-danger btn-xs btn-deletar" data-atividade-id="<?php echo $dadoAtividade['ID'];?>" data-title="Deletar" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                </tr>  
                
                <?php endforeach;
                    endif;
                ?>                             
               </tbody>                
        	</table>

			<div class="clearfix"></div>
                
        </div> 
        <input type="submit" class="btn btn-success criarnovo" value="&nbsp;Criar Novo&nbsp;" name="criar">           
        </div>
	</div>
</div>


	<div class="modal fade" id="delete" tabindex="-1" role="dialog"
		aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
					<h4 class="modal-title custom_align" id="Heading">Deletar registro</h4>
				</div>
				<div class="modal-body">

					<div class="alert alert-danger">
						<span class="glyphicon glyphicon-warning-sign"></span> Tem certeza que quer deletar esse registro?
					</div>

				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-success" id="deleta-atividade">
						<span class="glyphicon glyphicon-ok-sign"></span> SIM
					</button>
					<input type="hidden" value="" id="id-atividade-deletada">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span> N&Atilde;O
					</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</body>
</html>
